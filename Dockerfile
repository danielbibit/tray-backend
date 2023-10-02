FROM php:8.2-fpm

WORKDIR /var/www/html/tray-backend

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    unzip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . .

RUN composer install
