FROM composer:2.4 as vendor
FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y \
    curl \
    libonig-dev \
    libzip-dev \
    unzip

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl

COPY /server/nginx/default.conf /etc/nginx/conf.d/default.conf

# RUN a2enmod rewrite ssl

WORKDIR /var/www/mikman
COPY composer.json composer.lock ./
COPY . /var/www/mikman

COPY --from=vendor /usr/bin/composer /usr/bin/composer
RUN composer install 

RUN chown -R www-data:www-data \
    /var/www/mikman/storage \
    /var/www/mikman/bootstrap/cache

RUN php artisan key:generate

RUN php artisan optimize


