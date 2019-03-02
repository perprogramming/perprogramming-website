FROM php:7-alpine

WORKDIR /app
ADD . /app

RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar install
