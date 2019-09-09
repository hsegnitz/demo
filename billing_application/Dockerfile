FROM php:7.3-apache

MAINTAINER Holger Segnitz <holger@segnitz.net>

RUN pecl install -f -o redis xdebug
RUN docker-php-ext-enable redis.so xdebug.so
