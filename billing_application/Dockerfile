FROM php:7.3-apache

MAINTAINER Holger Segnitz <holger@segnitz.net>

RUN pecl install -f -o xdebug-3.1.6
RUN docker-php-ext-enable xdebug.so
