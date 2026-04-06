# ECS Fargate Deployment Plan — MHCampaignApi

## Context

Deploy the MHCampaignApi Laravel 12 REST API to AWS ECS Fargate with a fully automated CI/CD pipeline. The goal is a production-grade, zero-touch deployment: push to `main`, tests run, image builds, migrations execute, and the service rolls over — all without manual steps.

**Choices made:**
- IaC: Terraform
- HTTPS: deferred (HTTP only via ALB DNS for now; ACM/Route53 added later)
- Networking: NAT Gateway + private subnets for ECS/RDS (cleanest architecture)

---

## Target Architecture

```
GitHub Actions (push to main)
  └── test → build+push ECR → migrate (one-off ECS task) → deploy (rolling update)

Internet → ALB (HTTP:80) → ECS Fargate Task (private subnet)
                                ├── nginx container  (port 80, public-facing)
                                └── fpm container    (port 9000, sidecar, internal)
                                      └── env injected from Secrets Manager

ECS Task → RDS PostgreSQL (private subnet, port 5432)
```

Both `nginx` and `fpm` run as sidecars in a **single ECS task** — they share `localhost` for internal communication. `nginx` proxies to `127.0.0.1:9000`.

---

## Files to Create / Modify

```
MHCampaignApi/
├── docker/
│   ├── app/
│   │   ├── Dockerfile              ← unchanged (dev only)
│   │   ├── Dockerfile.prod         ← NEW: production image (no xdebug, copies code, entrypoint)
│   │   └── entrypoint.sh           ← NEW: caches config/routes/views, then execs php-fpm
│   └── web/
│       ├── default.conf            ← MODIFY: change fastcgi_pass from fpm:9000 → 127.0.0.1:9000
│       └── Dockerfile              ← NEW: nginx image with config baked in (for ECS)
├── infrastructure/
│   └── terraform/
│       ├── main.tf                 ← provider, S3 backend
│       ├── variables.tf
│       ├── outputs.tf
│       ├── vpc.tf                  ← VPC, public/private subnets, IGW, NAT, route tables
│       ├── security_groups.tf      ← ALB SG, ECS SG, RDS SG
│       ├── ecr.tf                  ← two ECR repos: fpm image, nginx image
│       ├── rds.tf                  ← RDS PostgreSQL db.t3.micro
│       ├── secrets.tf              ← Secrets Manager secret (APP_KEY, DB_USERNAME, DB_PASSWORD)
│       ├── iam.tf                  ← ECS task execution role + task role + GitHub OIDC role
│       ├── ecs.tf                  ← cluster, task definition (fpm+nginx sidecars), service
│       ├── alb.tf                  ← ALB, target group (health: /up), HTTP listener
│       ├── cloudwatch.tf           ← log groups for fpm and nginx
│       └── terraform.tfvars.example
├── .github/
│   └── workflows/
│       ├── test.yml                ← unchanged
│       ├── lint.yml                ← unchanged
│       └── deploy.yml              ← NEW: full CD pipeline
└── .gitignore                      ← MODIFY: add terraform.tfvars, *.tfstate, *.tfstate.backup
```

---

## Phase 1 — Docker Production Image

### `docker/app/Dockerfile.prod`

Multi-stage build:
- **Stage 1 (`builder`):** `FROM php:8.2-fpm-alpine` — installs `libpq-dev`, runs `composer install --no-dev --optimize-autoloader`. No xdebug, no build tools in final image.
- **Stage 2 (final):** `FROM php:8.2-fpm-alpine` — installs only `libpq-dev` (runtime dep), copies `/var/www/html` from builder, sets `COPY --chown=www-data:www-data`, copies `entrypoint.sh`, sets `CMD ["/entrypoint.sh"]`.

### `docker/app/entrypoint.sh`

Runs at container startup (after ECS injects env vars):
```sh
#!/bin/sh
set -e
php artisan config:cache
php artisan route:cache
php artisan view:cache
exec php-fpm
```

**Why at runtime, not build time:** config cache embeds env var values. If baked at build time, APP_KEY/DB_HOST are empty. ECS guarantees all `secrets` are injected before the entrypoint runs.

### `docker/web/default.conf` — one change

```nginx
# change this line:
fastcgi_pass  fpm:9000;
# to:
fastcgi_pass  127.0.0.1:9000;
```

Both containers share `localhost` inside a Fargate task (awsvpc network mode).

### `docker/web/Dockerfile`

```dockerfile
FROM nginx:alpine
COPY default.conf /etc/nginx/conf.d/default.conf
```

Needed because Fargate has no bind mounts — the nginx config must be baked into the image.

---

## Phase 2 — Terraform Infrastructure

### Order of resource dependencies

```
VPC → Subnets → IGW + NAT → Security Groups
Security Groups → RDS, ECS, ALB
ECR → (images pushed here before ECS can start)
Secrets Manager → ECS task definition
IAM roles → ECS task definition
RDS + IAM + Secrets → ECS task definition
ECS task definition + ALB target group → ECS service
ALB + ECS service → outputs (ALB DNS)
```

### `vpc.tf`

- 1 VPC (`10.0.0.0/16`)
- 2 public subnets (`10.0.1.0/24`, `10.0.2.0/24`) — for ALB, across 2 AZs
- 2 private subnets (`10.0.3.0/24`, `10.0.4.0/24`) — for ECS + RDS, across 2 AZs
- Internet Gateway → public route table
- NAT Gateway (1, in first public subnet) → private route table
- EIP for NAT Gateway

### `security_groups.tf`

| SG | Inbound | Outbound |
|---|---|---|
| ALB SG | 80 from `0.0.0.0/0` | 80 to ECS SG |
| ECS SG | 80 from ALB SG | 5432 to RDS SG, 443 to `0.0.0.0/0` (ECR + Secrets Manager) |
| RDS SG | 5432 from ECS SG | none |

### `ecr.tf`

Two repositories:
- `mhapi/fpm` — PHP application image
- `mhapi/nginx` — nginx sidecar image

Settings: `image_tag_mutability = "MUTABLE"`, `scan_on_push = true`, lifecycle policy keeps last 10 images.

### `rds.tf`

- Engine: `postgres`, version `16` (RDS lags behind upstream — 18 not yet available)
- Instance: `db.t3.micro`
- Private subnet group (both private subnets)
- RDS SG attached
- `storage_encrypted = true`
- `skip_final_snapshot = true` (portfolio project)
- `backup_retention_period = 7`
- Credentials from `var.db_username` / `var.db_password`

### `secrets.tf`

One Secrets Manager secret: `mhapi/app` (JSON):
```json
{
  "APP_KEY": "placeholder — update after terraform apply",
  "DB_USERNAME": "placeholder",
  "DB_PASSWORD": "placeholder"
}
```
Cost: $0.40/month for one secret (vs $0.40/month each if split).

### `iam.tf`

**ECS Task Execution Role** (infrastructure-level — used by ECS agent):
- Trust: `ecs-tasks.amazonaws.com`
- Managed: `AmazonECSTaskExecutionRolePolicy` (ECR pull + CloudWatch logs)
- Inline: `secretsmanager:GetSecretValue` scoped to `mhapi/app` ARN

**ECS Task Role** (application-level — assumed by running container):
- Trust: `ecs-tasks.amazonaws.com`
- No permissions yet — add S3/SQS here later as needed

**GitHub OIDC Role** (for GitHub Actions — no static keys):
- OIDC provider: `token.actions.githubusercontent.com`
- Trust condition scoped to repo: `repo:YOUR_GITHUB_USER/MHCampaignApi:ref:refs/heads/main`
- Permissions: ECR push, `ecs:RunTask`, `ecs:DescribeTasks`, `ecs:DescribeTaskDefinition`, `ecs:RegisterTaskDefinition`, `ecs:UpdateService`, `ecs:DescribeServices`, `iam:PassRole` (scoped to task roles)

### `ecs.tf`

**Cluster:** `mhapi-cluster`, Fargate capacity provider.

**Task Definition:** `mhapi-app`
- `network_mode = "awsvpc"`, `requires_compatibilities = ["FARGATE"]`
- `cpu = 256`, `memory = 512`
- `execution_role_arn` = execution role, `task_role_arn` = task role

**fpm container:**
- Image: `<ecr_fpm_url>:latest`
- Essential: true
- Plain env vars: `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=http://<alb_dns>`, `DB_CONNECTION=pgsql`, `DB_HOST=<rds_endpoint>`, `DB_PORT=5432`, `DB_DATABASE=mhapi`, `LOG_CHANNEL=stderr`, `LOG_LEVEL=error`, `SESSION_DRIVER=database`, `CACHE_STORE=database`, `QUEUE_CONNECTION=database`, `BCRYPT_ROUNDS=12`
- Secrets (from `mhapi/app`): `APP_KEY`, `DB_USERNAME`, `DB_PASSWORD`
- Logs: `awslogs`, group `/ecs/mhapi/fpm`

**nginx container:**
- Image: `<ecr_nginx_url>:latest`
- Essential: true
- Port mapping: `80:80`
- Logs: `awslogs`, group `/ecs/mhapi/nginx`

**Service:** `mhapi-service`
- `desired_count = 1`
- Private subnets, ECS SG, `assign_public_ip = DISABLED`
- ALB target group attached
- `health_check_grace_period_seconds = 60` — allows entrypoint cache commands to finish before ALB probes start
- Rolling deploy: `deployment_minimum_healthy_percent = 50`, `deployment_maximum_percent = 200`

### `alb.tf`

- ALB in both public subnets, ALB SG
- Target group: `HTTP:80`, health check `GET /up`, healthy=2, unhealthy=3, interval=30s
- HTTP listener on port 80 → forward to target group

### `cloudwatch.tf`

Two log groups: `/ecs/mhapi/fpm` and `/ecs/mhapi/nginx`, retention 14 days.

---

## Phase 3 — CI/CD Pipeline (`deploy.yml`)

Triggers on `push` to `main`.

### Jobs

```
test → build-push → migrate → deploy
```

**`test` job** — re-runs full test suite (self-contained, same as test.yml). Deploy never proceeds if tests fail.

**`build-push` job:**
1. Checkout
2. `aws-actions/configure-aws-credentials@v4` — OIDC, no static keys
3. Login to ECR
4. Compute tag: `IMAGE_TAG=$(echo ${{ github.sha }} | cut -c1-7)`
5. Build `docker/app/Dockerfile.prod` → push as `<ecr_fpm_url>:$IMAGE_TAG` and `<ecr_fpm_url>:latest`
6. Build `docker/web/Dockerfile` → push as `<ecr_nginx_url>:latest`
7. Output `IMAGE_TAG` for downstream jobs

**`migrate` job:**
1. Configure AWS credentials (OIDC)
2. `aws ecs run-task` — same task definition, command override: `["php", "artisan", "migrate", "--force", "&&", "php", "artisan", "permission:cache-reset"]`
   - Must specify `networkConfiguration` (private subnets + ECS SG)
3. `aws ecs wait tasks-stopped` — blocks until task exits
4. `aws ecs describe-tasks` — parse `exitCode`; fail job if non-zero
5. **If migrations fail, deploy job never runs** — old version keeps serving

**`deploy` job:**
1. Configure AWS credentials (OIDC)
2. `aws ecs describe-task-definition` → download current task definition JSON
3. `aws-actions/amazon-ecs-render-task-definition@v1` → update fpm container image to new tag
4. `aws-actions/amazon-ecs-deploy-task-definition@v1` → registers new revision, updates service, waits for deployment to stabilize

**GitHub repository variables (non-secret):**
- `AWS_ROLE_ARN`, `AWS_REGION`, `ECR_FPM_URL`, `ECR_NGINX_URL`, `ECS_CLUSTER`, `ECS_SERVICE`, `ECS_TASK_DEFINITION`, `VPC_PRIVATE_SUBNET_1`, `VPC_PRIVATE_SUBNET_2`, `ECS_SECURITY_GROUP`

---

## Phase 4 — Order of Operations

1. **Implement and test production Docker images locally**
   - Build `Dockerfile.prod`, verify `php artisan --version` runs inside the image
   - Build `docker/web/Dockerfile`, verify nginx config is present

2. **Bootstrap Terraform state backend** (manual, one-time)
   - Create S3 bucket `mhapi-terraform-state` with versioning enabled
   - Create DynamoDB table `mhapi-terraform-locks` (partition key: `LockID`, type: String)

3. **Write all Terraform files and run `terraform plan`** — review before applying

4. **`terraform apply`** — creates all infrastructure
   - ECS service will fail to start (ECR repos are empty) — expected

5. **Seed Secrets Manager** (after apply, using `outputs.tf` values)
   ```sh
   # Generate APP_KEY locally
   docker run --rm php:8.2-cli php -r "echo 'base64:'.base64_encode(random_bytes(32)).PHP_EOL;"
   aws secretsmanager update-secret --secret-id mhapi/app \
     --secret-string '{"APP_KEY":"base64:...","DB_USERNAME":"mhapi","DB_PASSWORD":"..."}'
   ```

6. **First manual image push** to unblock ECS
   ```sh
   docker build -f docker/app/Dockerfile.prod -t <ecr_fpm_url>:latest .
   docker build -f docker/web/Dockerfile -t <ecr_nginx_url>:latest docker/web/
   # push both
   aws ecs update-service --cluster mhapi-cluster --service mhapi-service --force-new-deployment
   ```
   Verify: `curl http://<alb_dns>/up` returns `{"status":"ok"}`

7. **Run first migration manually** (one-off ECS task)

8. **Configure GitHub Actions**
   - Add repository variables listed above
   - Write `deploy.yml`
   - Push a commit to `main` and watch the full pipeline

---

## Key Gotchas

| Issue | Solution |
|---|---|
| `config:cache` bakes in empty env vars if run at build time | Run in `entrypoint.sh` at container startup — ECS injects secrets before entrypoint executes |
| `LOG_CHANNEL=stack` writes to filesystem | Use `LOG_CHANNEL=stderr` — logs go to CloudWatch via `awslogs` driver |
| ALB kills task before fpm is ready | `health_check_grace_period_seconds = 60` on ECS service |
| nginx can't resolve `fpm` hostname (no Docker DNS in Fargate) | Change `fastcgi_pass` to `127.0.0.1:9000` in `default.conf` |
| Migrations run against wrong DB | Migration task uses same task definition + secrets — same DB credentials guaranteed |
| Spatie permission cache stale after migration | Add `php artisan permission:cache-reset` to migration task command |
| RDS PostgreSQL 18 not available | Use PostgreSQL 16 on RDS (latest generally available version) |
| `storage/` ownership | `COPY --chown=www-data:www-data` in `Dockerfile.prod` + `chmod 755 storage bootstrap/cache` |

---

## Verification

1. `curl http://<alb_dns>/up` → `{"status":"ok"}`
2. `curl -X POST http://<alb_dns>/api/auth/register` with test payload → 201 response
3. Check CloudWatch log groups `/ecs/mhapi/fpm` and `/ecs/mhapi/nginx` for request logs
4. Push a trivial commit to `main` → watch all 4 CI/CD jobs pass in GitHub Actions
5. Push a new migration → verify the `migrate` job runs it before the `deploy` job updates the service
