FROM php:7.4.10-apache

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update

RUN apt-get install -y libzip-dev unzip git
RUN docker-php-ext-install zip pdo pdo_mysql
RUN a2enmod rewrite

RUN pecl install xdebug-2.9.5 && docker-php-ext-enable xdebug

ARG UID=1000

RUN echo "dev:x:$UID:$UID:dev,,,:/home/dev:/bin/bash" >> /etc/passwd
ENV HOME /home/dev
ENV COMPOSER_HOME /home/dev/.composer
RUN mkdir /home/dev/