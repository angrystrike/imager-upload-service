FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    zip unzip git libpng-dev libjpeg-dev libonig-dev libxml2-dev \
    librabbitmq-dev libssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd fileinfo \
    && pecl install amqp redis \
    && docker-php-ext-enable amqp redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install
