resource "aws_secretsmanager_secret" "app" {
  name        = "${var.project_name}/app"
  description = "MHApi application secrets: APP_KEY, DB credentials, Google OAuth"

  tags = { Name = "${var.project_name}-app-secrets" }
}

resource "aws_secretsmanager_secret_version" "app" {
  secret_id = aws_secretsmanager_secret.app.id

  # After apply, update real values via:
  # aws secretsmanager update-secret --secret-id mhapi/app --secret-string '{
  #   "APP_KEY":              "base64:...",
  #   "DB_USERNAME":          "mhapi",
  #   "DB_PASSWORD":          "...",
  #   "GOOGLE_CLIENT_ID":     "...",
  #   "GOOGLE_CLIENT_SECRET": "..."
  # }'
  secret_string = jsonencode({
    APP_KEY              = "placeholder"
    DB_USERNAME          = var.db_username
    DB_PASSWORD          = var.db_password
    GOOGLE_CLIENT_ID     = "placeholder"
    GOOGLE_CLIENT_SECRET = "placeholder"
  })

  lifecycle {
    ignore_changes = [secret_string]
  }
}
