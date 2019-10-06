FROM php:7.0-apache

MAINTAINER Holger Segnitz <holger@segnitz.net>

RUN pecl install -f -o xdebug
RUN docker-php-ext-enable xdebug.so
