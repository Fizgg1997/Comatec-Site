#!/bin/sh
set -e

if [ ! -f /var/www/html/vendor/autoload.php ]; then
  echo "ERROR: vendor/autoload.php is missing. Composer install did not run."
  exit 1
fi

rm -f bootstrap/cache/config.php bootstrap/cache/routes-*.php bootstrap/cache/events-*.php bootstrap/cache/services.php || true

mkdir -p storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan config:clear
php artisan cache:clear
php artisan view:clear
exec apache2-foreground
