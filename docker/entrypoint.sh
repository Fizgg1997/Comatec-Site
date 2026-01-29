#!/bin/sh
set -e

# Optional: show env quickly (helps debug in Railway logs)
echo "APP_ENV=$APP_ENV"
echo "APP_URL=$APP_URL"
echo "DB_HOST=$DB_HOST"
echo "DB_PORT=$DB_PORT"
echo "DB_DATABASE=$DB_DATABASE"
echo "DB_USERNAME=$DB_USERNAME"

# If you want migrations always (recommended first time):
php artisan migrate --force || true

# If you have Voyager and seeders you can add later:
# php artisan db:seed --force || true

exec "$@"
