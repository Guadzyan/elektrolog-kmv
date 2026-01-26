#!/usr/bin/env bash
set -euo pipefail

APP_DIR="${APP_DIR:-$HOME/apps/elektrolog-kmv}"
PHP_BIN="${PHP_BIN:-php82}"
COMPOSER_BIN="${COMPOSER_BIN:-$HOME/bin/composer}"

cd "$APP_DIR"

echo "==> Pulling latest code"
git pull

echo "==> Installing PHP dependencies"
"$PHP_BIN" "$COMPOSER_BIN" install --no-dev --optimize-autoloader

echo "==> Running migrations"
"$PHP_BIN" artisan migrate --force

echo "==> Caching config"
"$PHP_BIN" artisan config:clear
"$PHP_BIN" artisan cache:clear
"$PHP_BIN" artisan config:cache

echo "==> Caching routes (optional)"
"$PHP_BIN" artisan route:cache || true

echo "==> Done"
