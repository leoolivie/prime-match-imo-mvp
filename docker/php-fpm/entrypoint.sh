#!/bin/sh
set -e

APP_DIR="/var/www/html"

ensure_dir() {
    if [ ! -d "$1" ]; then
        mkdir -p "$1"
    fi
}

ensure_dir "$APP_DIR/storage"
ensure_dir "$APP_DIR/storage/framework"
ensure_dir "$APP_DIR/storage/framework/cache"
ensure_dir "$APP_DIR/storage/framework/sessions"
ensure_dir "$APP_DIR/storage/framework/testing"
ensure_dir "$APP_DIR/storage/framework/views"
ensure_dir "$APP_DIR/storage/logs"
ensure_dir "$APP_DIR/bootstrap/cache"

chmod -R 777 "$APP_DIR/storage" "$APP_DIR/bootstrap/cache" 2>/dev/null || true

exec /usr/local/bin/docker-php-entrypoint "$@"

