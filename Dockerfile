FROM php:8.2-cli

# System deps for PHP extensions + imagick + node build tools
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip curl ca-certificates \
    libzip-dev zlib1g-dev \
    libicu-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libgmp-dev \
    libmagickwand-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-configure intl \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
    pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl gmp

# Imagick
RUN pecl install imagick && docker-php-ext-enable imagick

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node 20 (for Vite build)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y --no-install-recommends nodejs \
    && node -v && npm -v \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

# Composer env
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_PROCESS_TIMEOUT=0

# Install PHP deps
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-progress

# Build frontend if package.json exists
RUN if [ -f package.json ]; then npm ci --no-audit --no-fund || npm install; npm run build; fi

# Permissions (needed for Laravel)
RUN mkdir -p storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache

# Clear caches (safe even without DB)
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan route:clear \
 && php artisan view:clear || true

# ---- Runtime startup ----
# NOTE: DO NOT run migrations at build-time.
# We'll run them at container start.

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8080
ENTRYPOINT ["/entrypoint.sh"]
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t public"]
