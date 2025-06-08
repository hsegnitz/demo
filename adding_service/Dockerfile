FROM php:7.2-apache

MAINTAINER Holger Segnitz <holger@segnitz.net>

RUN pecl install -f -o xdebug-3.0.4
RUN docker-php-ext-enable xdebug.so
