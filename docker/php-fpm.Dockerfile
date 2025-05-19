FROM php:8.2-fpm

RUN pecl channel-update pecl.php.net && pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www/lead-status-panel