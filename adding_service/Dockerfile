FROM php:7.2-apache

MAINTAINER Holger Segnitz <holger@segnitz.net>

RUN pecl install -f -o redis xdebug
RUN docker-php-ext-enable redis.so xdebug.so
