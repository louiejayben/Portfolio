FROM node:22-alpine AS frontend

WORKDIR /app
COPY package.json ./
RUN npm install
COPY . .
RUN npm run build

FROM php:8.4-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libcurl4-openssl-dev \
        libxml2-dev \
        libpq-dev \
        libonig-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install \
        curl dom mbstring pdo_mysql pdo_pgsql xml zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
        /etc/apache2/sites-available/*.conf \
        /etc/apache2/apache2.conf \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' \
        /etc/apache2/apache2.conf \
    && sed -ri 's/Listen 80/Listen 10000/' \
        /etc/apache2/ports.conf \
    && sed -ri 's/<VirtualHost \*:80>/<VirtualHost *:10000>/' \
        /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . .


COPY --from=frontend /app/public/build ./public/build

RUN composer install --no-dev --no-interaction \
        --prefer-dist --optimize-autoloader \
    && mkdir -p \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

EXPOSE 10000

CMD ["apache2-foreground"]
