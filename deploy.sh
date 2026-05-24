#!/usr/bin/env bash
# ─────────────────────────────────────────────────────────────────
# Deploy script for Hostinger shared hosting.
# Run on the SERVER over SSH:
#   cd ~/domains/yourdomain.com/laravel && ./deploy.sh
#
# Assumes:
#   • This folder is a git checkout of the project (origin = GitHub)
#   • .env exists in this folder (never committed)
#   • Composer is available on the server (Business+ plans have it)
#   • public/build/ is tracked in git (so no Node needed on the server)
# ─────────────────────────────────────────────────────────────────
set -euo pipefail
cd "$(dirname "$0")"

BRANCH="${DEPLOY_BRANCH:-main}"

# PHP 8.4 binary — Hostinger ships it at /opt/alt/php84/usr/bin/php.
# Override by exporting PHP_BIN before running.
PHP_BIN="${PHP_BIN:-/opt/alt/php84/usr/bin/php}"
if [ ! -x "$PHP_BIN" ]; then
  PHP_BIN="$(command -v php)"   # fall back to whatever's on PATH
fi
COMPOSER_BIN="${COMPOSER_BIN:-/usr/bin/composer}"
composer() { "$PHP_BIN" "$COMPOSER_BIN" "$@"; }
php()      { "$PHP_BIN" "$@"; }

echo "→ Pulling latest from origin/${BRANCH}"
git fetch origin "${BRANCH}"
git reset --hard "origin/${BRANCH}"   # discards any accidental edits on server

echo "→ Installing PHP dependencies (production)"
composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

echo "→ Running migrations"
php artisan migrate --force

echo "→ Clearing and rebuilding caches"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear || true
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache || true

echo "→ Ensuring storage symlink"
php artisan storage:link 2>/dev/null || true

echo "→ Setting writable permissions on storage / bootstrap/cache"
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "✓ Deploy complete"
