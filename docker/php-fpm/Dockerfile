FROM php:7.2-fpm

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
RUN apt-get update
RUN apt-get install -y libpng-dev
RUN docker-php-ext-install gd
