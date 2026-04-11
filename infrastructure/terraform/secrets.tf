resource "aws_secretsmanager_secret" "app" {
  name        = "${var.project_name}/app"
  description = "MHApi application secrets: APP_KEY, DB_USERNAME, DB_PASSWORD"

  tags = { Name = "${var.project_name}-app-secrets" }
}

resource "aws_secretsmanager_secret_version" "app" {
  secret_id = aws_secretsmanager_secret.app.id

  # APP_KEY must be updated after first apply via:
  # aws secretsmanager update-secret --secret-id mhapi/app \
  #   --secret-string '{"APP_KEY":"base64:...","DB_USERNAME":"mhapi","DB_PASSWORD":"..."}'
  secret_string = jsonencode({
    APP_KEY     = "placeholder"
    DB_USERNAME = var.db_username
    DB_PASSWORD = var.db_password
  })

  lifecycle {
    # Prevent Terraform from overwriting the secret after the initial apply
    # so that APP_KEY updates via CLI are not reverted on next terraform apply
    ignore_changes = [secret_string]
  }
}
