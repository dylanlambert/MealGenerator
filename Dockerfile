FROM php:7.4.10-apache

COPY --from=composer:1.10.5 /usr/bin/composer /usr/bin/composer

RUN apt-get update

RUN apt-get install -y libzip-dev unzip git
RUN docker-php-ext-install zip pdo pdo_mysql
RUN a2enmod rewrite