resource "aws_cloudwatch_log_group" "fpm" {
  name              = "/ecs/${var.project_name}/fpm"
  retention_in_days = 14

  tags = { Name = "${var.project_name}-fpm-logs" }
}

resource "aws_cloudwatch_log_group" "nginx" {
  name              = "/ecs/${var.project_name}/nginx"
  retention_in_days = 14

  tags = { Name = "${var.project_name}-nginx-logs" }
}
