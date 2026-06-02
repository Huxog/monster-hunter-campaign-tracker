resource "aws_ecs_cluster" "main" {
  name = "${var.project_name}-cluster"

  tags = { Name = "${var.project_name}-cluster" }
}

resource "aws_ecs_cluster_capacity_providers" "main" {
  cluster_name       = aws_ecs_cluster.main.name
  capacity_providers = ["FARGATE"]

  default_capacity_provider_strategy {
    capacity_provider = "FARGATE"
    weight            = 1
  }
}

resource "aws_ecs_task_definition" "app" {
  family                   = "${var.project_name}-app"
  network_mode             = "awsvpc"
  requires_compatibilities = ["FARGATE"]
  cpu                      = 256
  memory                   = 512
  execution_role_arn       = aws_iam_role.ecs_execution.arn
  task_role_arn            = aws_iam_role.ecs_task.arn

  container_definitions = jsonencode([
    {
      name      = "fpm"
      image     = "${aws_ecr_repository.fpm.repository_url}:latest"
      essential = true

      environment = [
        { name = "APP_NAME",           value = "MHW: The board game" },
        { name = "APP_ENV",            value = "production" },
        { name = "APP_DEBUG",          value = "false" },
        { name = "APP_URL",            value = "https://${var.api_domain}" },
        { name = "FRONTEND_URL",       value = var.frontend_url },
        { name = "DB_CONNECTION",      value = "pgsql" },
        { name = "DB_HOST",            value = aws_db_instance.main.address },
        { name = "DB_PORT",            value = "5432" },
        { name = "DB_DATABASE",        value = var.db_name },
        { name = "LOG_CHANNEL",        value = "stderr" },
        { name = "LOG_LEVEL",          value = "error" },
        { name = "SESSION_DRIVER",     value = "database" },
        { name = "CACHE_STORE",        value = "database" },
        { name = "QUEUE_CONNECTION",   value = "database" },
        { name = "BCRYPT_ROUNDS",      value = "12" },
        { name = "GOOGLE_REDIRECT_URI", value = "https://${var.api_domain}/api/v1/auth/google/callback" },
      ]

      secrets = [
        { name = "APP_KEY",              valueFrom = "${aws_secretsmanager_secret.app.arn}:APP_KEY::" },
        { name = "DB_USERNAME",          valueFrom = "${aws_secretsmanager_secret.app.arn}:DB_USERNAME::" },
        { name = "DB_PASSWORD",          valueFrom = "${aws_secretsmanager_secret.app.arn}:DB_PASSWORD::" },
        { name = "GOOGLE_CLIENT_ID",     valueFrom = "${aws_secretsmanager_secret.app.arn}:GOOGLE_CLIENT_ID::" },
        { name = "GOOGLE_CLIENT_SECRET", valueFrom = "${aws_secretsmanager_secret.app.arn}:GOOGLE_CLIENT_SECRET::" },
      ]

      logConfiguration = {
        logDriver = "awslogs"
        options = {
          "awslogs-group"         = aws_cloudwatch_log_group.fpm.name
          "awslogs-region"        = var.aws_region
          "awslogs-stream-prefix" = "ecs"
        }
      }
    },
    {
      name      = "nginx"
      image     = "${aws_ecr_repository.nginx.repository_url}:latest"
      essential = true

      portMappings = [
        { containerPort = 80, protocol = "tcp" }
      ]

      dependsOn = [
        { containerName = "fpm", condition = "START" }
      ]

      logConfiguration = {
        logDriver = "awslogs"
        options = {
          "awslogs-group"         = aws_cloudwatch_log_group.nginx.name
          "awslogs-region"        = var.aws_region
          "awslogs-stream-prefix" = "ecs"
        }
      }
    }
  ])

  tags = { Name = "${var.project_name}-app-task" }
}

resource "aws_ecs_service" "app" {
  name            = "${var.project_name}-service"
  cluster         = aws_ecs_cluster.main.id
  task_definition = aws_ecs_task_definition.app.arn
  desired_count   = 1
  launch_type     = "FARGATE"

  network_configuration {
    subnets          = aws_subnet.private[*].id
    security_groups  = [aws_security_group.ecs.id]
    assign_public_ip = false
  }

  load_balancer {
    target_group_arn = aws_lb_target_group.app.arn
    container_name   = "nginx"
    container_port   = 80
  }

  health_check_grace_period_seconds  = 60
  deployment_minimum_healthy_percent = 50
  deployment_maximum_percent         = 200

  depends_on = [aws_lb_listener.https]

  tags = { Name = "${var.project_name}-service" }
}
