#!/bin/sh
set -e

# If composer deps are missing, fail with clear message
if [ ! -f /var/www/html/vendor/autoload.php ]; then
  echo "ERROR: vendor/autoload.php missing. Composer install did not run during build."
  echo "Make sure Render is deploying using Dockerfile OR run composer install in build step."
  exit 1
fi

rm -f bootstrap/cache/config.php bootstrap/cache/routes-*.php bootstrap/cache/events-*.php bootstrap/cache/services.php || true

mkdir -p storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

exec apache2-foreground
