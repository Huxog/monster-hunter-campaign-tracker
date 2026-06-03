#!/bin/bash

set -e

PID_FILE=/tmp/mh-db-tunnel.pid
LOCAL_PORT=5432
REGION=us-west-1

start() {
    if [ -f "$PID_FILE" ] && kill -0 "$(cat "$PID_FILE")" 2>/dev/null; then
        echo "Tunnel already running (PID $(cat "$PID_FILE")). Run 'make db-tunnel-stop' first."
        exit 1
    fi

    echo "Reading Terraform outputs..."
    BASTION_ID=$(terraform -chdir=infrastructure/terraform output -raw bastion_instance_id)
    DB_HOST=$(terraform -chdir=infrastructure/terraform output -raw db_endpoint)

    echo "Starting SSM tunnel → $DB_HOST:$LOCAL_PORT via bastion $BASTION_ID..."

    aws ssm start-session \
        --target "$BASTION_ID" \
        --document-name AWS-StartPortForwardingSessionToRemoteHost \
        --parameters "{\"host\":[\"$DB_HOST\"],\"portNumber\":[\"5432\"],\"localPortNumber\":[\"$LOCAL_PORT\"]}" \
        --region "$REGION" &

    echo $! > "$PID_FILE"
    sleep 1

    echo ""
    echo "Tunnel is up (PID $(cat "$PID_FILE"))"
    echo "Connect pgAdmin to:"
    echo "  Host:     localhost"
    echo "  Port:     $LOCAL_PORT"
    echo "  Database: mhapi"
    echo ""
    echo "Run 'make db-tunnel-stop' to close the tunnel."
}

stop() {
    if [ ! -f "$PID_FILE" ]; then
        echo "No tunnel running."
        exit 0
    fi

    PID=$(cat "$PID_FILE")

    if kill -0 "$PID" 2>/dev/null; then
        kill "$PID"
        echo "Tunnel stopped (PID $PID)."
    else
        echo "Tunnel process not found — it may have already exited."
    fi

    rm -f "$PID_FILE"
}

case "$1" in
    start) start ;;
    stop)  stop  ;;
    *)
        echo "Usage: $0 {start|stop}"
        exit 1
        ;;
esac
