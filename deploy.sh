#!/usr/bin/env bash
set -euo pipefail

APP_DIR="${APP_DIR:-$HOME/apps/elektrolog-kmv}"
COMPOSER_BIN="${COMPOSER_BIN:-$HOME/bin/composer}"

# Non-interactive SSH sessions may have a very limited PATH on shared hosting.
export PATH="$HOME/bin:/usr/local/bin:/usr/bin:/bin:/usr/sbin:/sbin:$PATH"

PHP_BIN="${PHP_BIN:-}"
if [[ -z "$PHP_BIN" ]]; then
  if command -v php82 >/dev/null 2>&1; then
    PHP_BIN="php82"
  elif command -v php >/dev/null 2>&1; then
    PHP_BIN="php"
  else
    echo "ERROR: PHP binary not found. Set PHP_BIN (e.g. PHP_BIN=/path/to/php82)" >&2
    exit 1
  fi
fi

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
