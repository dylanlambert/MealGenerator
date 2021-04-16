FROM php:8.0.3-apache

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update

RUN apt-get install -y libzip-dev unzip git
RUN docker-php-ext-install zip pdo pdo_mysql
RUN a2enmod rewrite

RUN mkdir -p /usr/src/php/ext/xdebug && curl -fsSL https://pecl.php.net/get/xdebug | tar xvz -C "/usr/src/php/ext/xdebug" --strip 1 && docker-php-ext-install xdebug
ENV APP_DEBUG true
ENV APP_ENV development
ARG UID=1000

RUN echo "dev:x:$UID:$UID:dev,,,:/home/dev:/bin/bash" >> /etc/passwd
ENV HOME /home/dev
ENV COMPOSER_HOME /home/dev/.composer
RUN mkdir /home/dev/