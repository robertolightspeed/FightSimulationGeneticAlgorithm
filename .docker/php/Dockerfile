FROM php:7.1-fpm

RUN docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-enable pdo_mysql

RUN apt-get update && apt-get install -y zlib1g-dev git \
    && docker-php-ext-install zip

RUN pecl install xdebug && docker-php-ext-enable xdebug

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer