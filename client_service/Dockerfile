FROM php:5.6-apache

MAINTAINER Holger Segnitz <holger@segnitz.net>

RUN apt-get update && apt-get install -y git

RUN git clone https://github.com/xdebug/xdebug.git \
&& cd xdebug \
&& git checkout tags/XDEBUG_2_5_5 \
&& phpize \
&& ./configure --enable-xdebug \
&& make \
&& make install
