# ./containers/php/Dockerfile
FROM php:8.2-fpm-alpine

RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories \
    && apk add -U shadow
## Install system dependencies
RUN apk update && \
    apk add php-mbstring php-zip libzip-dev icu-dev postgresql-dev bash yarn sudo \
    && docker-php-ext-configure intl \
    && docker-php-ext-install zip \
    intl \
    pdo \
    pdo_pgsql

## Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

## Install Symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add symfony-cli

## Copy project files to workdir
WORKDIR /var/www/app

RUN usermod -u 1000 www-data \
    && groupmod -g 1000 www-data

COPY --chown=www-data:www-data ../../ /var/www/app

COPY ./containers/php-fpm/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]