FROM php:8.2-cli

# -----------------------------
# System dependencies
# -----------------------------
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

# -----------------------------
# PHP extensions
# -----------------------------
RUN docker-php-ext-configure intl \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install \
    pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl gmp

# -----------------------------
# Imagick
# -----------------------------
RUN pecl install imagick \
 && docker-php-ext-enable imagick

# -----------------------------
# Composer
# -----------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -----------------------------
# Node.js (for Vite)
# -----------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get update \
 && apt-get install -y --no-install-recommends nodejs \
 && rm -rf /var/lib/apt/lists/*

# -----------------------------
# App directory
# -----------------------------
WORKDIR /var/www/html
COPY . .

# -----------------------------
# Composer install
# -----------------------------
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction \
    --no-progress

# -----------------------------
# Build frontend (if exists)
# -----------------------------
RUN if [ -f package.json ]; then \
      npm ci --no-audit --no-fund || npm install && npm run build ; \
    fi

# -----------------------------
# Permissions
# -----------------------------
RUN mkdir -p storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# -----------------------------
# Clear caches (NO MIGRATIONS)
# -----------------------------
RUN php artisan config:clear || true \
 && php artisan cache:clear || true \
 && php artisan route:clear || true \
 && php artisan view:clear || true

# -----------------------------
# Railway port
# -----------------------------
EXPOSE 8080

# -----------------------------
# Start Laravel
# -----------------------------
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t public"]
