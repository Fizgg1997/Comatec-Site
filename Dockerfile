FROM php:8.2-apache

RUN a2enmod rewrite

# System deps
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    libpng-dev libonig-dev libxml2-dev \
    libzip-dev libicu-dev \
    libgmp-dev \
    libmagickwand-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-configure intl \
    && docker-php-ext-install \
    pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl gmp

# Imagick (commonly required by image libs)
RUN pecl install imagick && docker-php-ext-enable imagick

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node 20 for Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && node -v && npm -v

WORKDIR /var/www/html
COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# Print details + install dependencies (verbose so Render shows the real error)
RUN php -v && php -m && composer -V \
 && composer install -vvv --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts

# Build frontend if present
RUN if [ -f package.json ]; then npm ci || npm install; npm run build; fi

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache docroot -> public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80
