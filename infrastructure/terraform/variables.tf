variable "aws_region" {
  description = "AWS region for all resources"
  type        = string
  default     = "us-west-1"
}

variable "project_name" {
  description = "Project name used as prefix for all resource names"
  type        = string
  default     = "mhapi"
}

variable "db_name" {
  description = "RDS database name"
  type        = string
  default     = "mhapi"
}

variable "db_username" {
  description = "RDS master username"
  type        = string
  sensitive   = true
}

variable "db_password" {
  description = "RDS master password"
  type        = string
  sensitive   = true
}

variable "root_domain" {
  description = "Root Route 53 hosted zone domain (e.g. huxog.com)"
  type        = string
  default     = "huxog.com"
}

variable "api_domain" {
  description = "Full subdomain for the API (e.g. mhtracker.api.huxog.com)"
  type        = string
  default     = "mhtracker.api.huxog.com"
}

variable "frontend_url" {
  description = "Frontend base URL — used by the API for OAuth redirects"
  type        = string
  default     = "https://mhtracker.huxog.com"
}
