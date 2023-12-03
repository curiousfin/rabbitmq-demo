FROM php:8.3-cli-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update && apk add --no-cache --virtual .build-deps autoconf g++ make yaml-dev unzip linux-headers
RUN apk add --no-cache \
    rabbitmq-c-dev

RUN pecl install amqp && docker-php-ext-enable amqp
RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /app