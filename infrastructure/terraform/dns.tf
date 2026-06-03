data "aws_route53_zone" "main" {
  name         = var.root_domain
  private_zone = false
}

resource "aws_acm_certificate" "api" {
  domain_name       = var.api_domain
  validation_method = "DNS"

  lifecycle {
    create_before_destroy = true
  }

  tags = { Name = "${var.project_name}-api-cert" }
}

resource "aws_route53_record" "cert_validation" {
  for_each = {
    for dvo in aws_acm_certificate.api.domain_validation_options : dvo.domain_name => {
      name   = dvo.resource_record_name
      type   = dvo.resource_record_type
      record = dvo.resource_record_value
    }
  }

  zone_id = data.aws_route53_zone.main.zone_id
  name    = each.value.name
  type    = each.value.type
  ttl     = 60
  records = [each.value.record]
}

resource "aws_acm_certificate_validation" "api" {
  certificate_arn         = aws_acm_certificate.api.arn
  validation_record_fqdns = [for r in aws_route53_record.cert_validation : r.fqdn]
}

# CNAME for the RDS endpoint — resolves inside the VPC only (private IP).
# Use this alias when connecting from within AWS. For local pgAdmin access,
# use SSM port forwarding and connect to localhost:5432 instead.
resource "aws_route53_record" "db" {
  zone_id = data.aws_route53_zone.main.zone_id
  name    = "mhtracker.db.${var.root_domain}"
  type    = "CNAME"
  ttl     = 300
  records = [aws_db_instance.main.address]
}

resource "aws_route53_record" "api" {
  zone_id = data.aws_route53_zone.main.zone_id
  name    = var.api_domain
  type    = "A"

  alias {
    name                   = aws_lb.main.dns_name
    zone_id                = aws_lb.main.zone_id
    evaluate_target_health = true
  }
}
