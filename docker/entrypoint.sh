#!/bin/sh
set -e

# Ensure required dirs exist
mkdir -p storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Clear caches AFTER env vars exist (Render injects them at runtime)
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Optional (only if you use these):
# php artisan storage:link || true
# php artisan migrate --force || true

exec apache2-foreground
