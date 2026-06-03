# ── Base security groups (no cross-references) ─────────────────────────────────
resource "aws_security_group" "alb" {
  name        = "${var.project_name}-alb-sg"
  description = "ALB: accepts HTTP from internet, forwards to ECS"
  vpc_id      = aws_vpc.main.id

  tags = { Name = "${var.project_name}-alb-sg" }
}

resource "aws_security_group" "ecs" {
  name        = "${var.project_name}-ecs-sg"
  description = "ECS tasks: accepts from ALB, reaches RDS and internet"
  vpc_id      = aws_vpc.main.id

  tags = { Name = "${var.project_name}-ecs-sg" }
}

resource "aws_security_group" "rds" {
  name        = "${var.project_name}-rds-sg"
  description = "RDS: accepts PostgreSQL from ECS only"
  vpc_id      = aws_vpc.main.id

  tags = { Name = "${var.project_name}-rds-sg" }
}

# ── ALB rules ──────────────────────────────────────────────────────────────────
resource "aws_security_group_rule" "alb_ingress_http" {
  type              = "ingress"
  security_group_id = aws_security_group.alb.id
  description       = "HTTP from internet"
  from_port         = 80
  to_port           = 80
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
}

resource "aws_security_group_rule" "alb_ingress_https" {
  type              = "ingress"
  security_group_id = aws_security_group.alb.id
  description       = "HTTPS from internet"
  from_port         = 443
  to_port           = 443
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
}

resource "aws_security_group_rule" "alb_egress_ecs" {
  type                     = "egress"
  security_group_id        = aws_security_group.alb.id
  description              = "Forward to ECS tasks"
  from_port                = 80
  to_port                  = 80
  protocol                 = "tcp"
  source_security_group_id = aws_security_group.ecs.id
}

# ── ECS rules ──────────────────────────────────────────────────────────────────
resource "aws_security_group_rule" "ecs_ingress_alb" {
  type                     = "ingress"
  security_group_id        = aws_security_group.ecs.id
  description              = "HTTP from ALB"
  from_port                = 80
  to_port                  = 80
  protocol                 = "tcp"
  source_security_group_id = aws_security_group.alb.id
}

resource "aws_security_group_rule" "ecs_egress_rds" {
  type                     = "egress"
  security_group_id        = aws_security_group.ecs.id
  description              = "PostgreSQL to RDS"
  from_port                = 5432
  to_port                  = 5432
  protocol                 = "tcp"
  source_security_group_id = aws_security_group.rds.id
}

resource "aws_security_group_rule" "ecs_egress_https" {
  type              = "egress"
  security_group_id = aws_security_group.ecs.id
  description       = "HTTPS outbound for ECR and Secrets Manager"
  from_port         = 443
  to_port           = 443
  protocol          = "tcp"
  cidr_blocks       = ["0.0.0.0/0"]
}

# ── Bastion rules ─────────────────────────────────────────────────────────────
resource "aws_security_group" "bastion" {
  name        = "${var.project_name}-bastion-sg"
  description = "Bastion: outbound only, accessed via SSM, no inbound ports"
  vpc_id      = aws_vpc.main.id

  tags = { Name = "${var.project_name}-bastion-sg" }
}

resource "aws_security_group_rule" "bastion_egress_all" {
  type              = "egress"
  security_group_id = aws_security_group.bastion.id
  description       = "Allow all outbound for SSM and RDS"
  from_port         = 0
  to_port           = 0
  protocol          = "-1"
  cidr_blocks       = ["0.0.0.0/0"]
}

# ── RDS rules ──────────────────────────────────────────────────────────────────
resource "aws_security_group_rule" "rds_ingress_ecs" {
  type                     = "ingress"
  security_group_id        = aws_security_group.rds.id
  description              = "PostgreSQL from ECS tasks"
  from_port                = 5432
  to_port                  = 5432
  protocol                 = "tcp"
  source_security_group_id = aws_security_group.ecs.id
}

resource "aws_security_group_rule" "rds_ingress_bastion" {
  type                     = "ingress"
  security_group_id        = aws_security_group.rds.id
  description              = "PostgreSQL from bastion via SSM tunnel"
  from_port                = 5432
  to_port                  = 5432
  protocol                 = "tcp"
  source_security_group_id = aws_security_group.bastion.id
}
