FROM php:8.2-fpm

WORKDIR /var/www/html/tray-backend

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . .

RUN composer install

CMD [ "php", "artisan", "serve", "--host=0.0.0.0", "--port=8000" ]
