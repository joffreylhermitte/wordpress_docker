FROM php:7.4-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update &&  \
    apt-get install -y libjpeg-dev libpng-dev libwebp-dev


RUN docker-php-ext-configure gd --with-jpeg --with-webp
RUN docker-php-ext-install gd