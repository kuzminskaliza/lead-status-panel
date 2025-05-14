FROM php:8.3-fpm

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

WORKDIR /var/www/lead-status-panel