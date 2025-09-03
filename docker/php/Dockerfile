FROM php:8.2-fpm-alpine

# Extensiones requeridas
RUN docker-php-ext-install pdo pdo_mysql

# Opcional: opcache para rendimiento
RUN docker-php-ext-install opcache

# Config PHP
COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-custom.ini

WORKDIR /var/www/html
