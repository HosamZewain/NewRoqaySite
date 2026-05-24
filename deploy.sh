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
COMPOSER_BIN="${COMPOSER_BIN:-/usr/local/bin/composer}"
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

# Hostinger shim mode: if a sibling public_html/ exists and is NOT a symlink to
# laravel/public, sync the latest static assets into it so /build, /images, etc
# stay current after each git pull.
SIBLING_PUBLIC="../public_html"
if [ -d "$SIBLING_PUBLIC" ] && [ ! -L "$SIBLING_PUBLIC" ]; then
  echo "→ Syncing public/ → public_html/ (shim mode)"
  cp -R public/build "$SIBLING_PUBLIC/" 2>/dev/null || true
  cp -R public/images "$SIBLING_PUBLIC/" 2>/dev/null || true
  cp -f public/robots.txt "$SIBLING_PUBLIC/" 2>/dev/null || true
  cp -f public/favicon.ico "$SIBLING_PUBLIC/" 2>/dev/null || true
fi

echo "→ Setting writable permissions on storage / bootstrap/cache"
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "✓ Deploy complete"
