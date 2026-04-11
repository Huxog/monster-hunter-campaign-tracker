output "alb_dns_name" {
  description = "ALB DNS name — use this to access the API"
  value       = aws_lb.main.dns_name
}

output "ecr_fpm_url" {
  description = "ECR repository URL for the fpm image"
  value       = aws_ecr_repository.fpm.repository_url
}

output "ecr_nginx_url" {
  description = "ECR repository URL for the nginx image"
  value       = aws_ecr_repository.nginx.repository_url
}

output "ecs_cluster_name" {
  description = "ECS cluster name"
  value       = aws_ecs_cluster.main.name
}

output "ecs_service_name" {
  description = "ECS service name"
  value       = aws_ecs_service.app.name
}

output "ecs_task_definition" {
  description = "ECS task definition family name"
  value       = aws_ecs_task_definition.app.family
}

output "rds_endpoint" {
  description = "RDS endpoint (sensitive)"
  value       = aws_db_instance.main.address
  sensitive   = true
}

output "private_subnet_1" {
  description = "First private subnet ID — for GitHub Actions run-task"
  value       = aws_subnet.private[0].id
}

output "private_subnet_2" {
  description = "Second private subnet ID — for GitHub Actions run-task"
  value       = aws_subnet.private[1].id
}

output "ecs_security_group_id" {
  description = "ECS security group ID — for GitHub Actions run-task"
  value       = aws_security_group.ecs.id
}

output "github_actions_role_arn" {
  description = "IAM role ARN to paste into GitHub repository variable AWS_ROLE_ARN"
  value       = aws_iam_role.github_actions.arn
}
