FROM php:8.2-cli

WORKDIR /var/www/html

# System deps + PHP extensions (adjust if you need more)
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
  && docker-php-ext-install pdo pdo_mysql zip \
  && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy app
COPY . .

# Install PHP deps (this creates vendor/autoload.php)
RUN composer install --no-dev --optimize-autoloader

# Laravel optimization (optional but good)
RUN php artisan config:clear && php artisan cache:clear && php artisan view:clear || true

# Railway provides PORT automatically
CMD php -S 0.0.0.0:$PORT -t public
