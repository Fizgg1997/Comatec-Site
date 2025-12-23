#!/bin/sh
set -e

# Remove any cached config/routes that may contain old/empty APP_KEY
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes-*.php
rm -f bootstrap/cache/events-*.php
rm -f bootstrap/cache/services.php

# Make sure cache dirs exist and are writable
mkdir -p storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Clear runtime caches (safe even if it fails first boot)
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

exec apache2-foreground
