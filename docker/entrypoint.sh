#!/bin/sh
set -e

if [ ! -f /var/www/html/vendor/autoload.php ]; then
  echo "ERROR: vendor/autoload.php is missing. Composer install did not run."
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
