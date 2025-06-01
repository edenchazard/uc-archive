# grab composer 🎶
FROM composer:latest AS composer

FROM node:24.0-alpine3.21 AS node
ARG VITE_BASE_URL="/unicreatures"
ENV VITE_BASE_URL=$VITE_BASE_URL
WORKDIR /var/www
COPY public ./public
COPY resources ./resources
COPY vite.config.js ./
COPY package.json package-lock.json ./
RUN [ "npm", "ci" ]
RUN [ "npm", "run", "build" ]

FROM php:8.4-fpm-alpine3.21 AS base
WORKDIR /var/www
RUN apk update && apk add curl-dev oniguruma-dev libxml2-dev icu-dev
RUN docker-php-ext-install mbstring pdo mysqli pdo_mysql intl

FROM base AS production
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY app ./app
COPY bootstrap ./bootstrap
COPY config ./config
COPY database ./database
COPY routes ./routes
COPY storage ./storage
COPY --from=node /var/www/public ./public
COPY resources ./resources

COPY composer.json composer.lock artisan ./
RUN composer install \
  --prefer-dist \
  --no-scripts \
  --no-progress \
  --no-interaction \
  --no-dev \
  --no-autoloader \
  && composer dump-autoload \
  --optimize \
  --apcu \
  --no-dev

RUN rm -rf /usr/bin/composer \
  && chown -R www-data:www-data /var/www \
  && chmod -R 555 .

RUN chmod -R 770 storage bootstrap/cache \
  && mkdir -p /var/www/storage/logs \
  && touch /var/www/storage/logs/laravel.log \
  && chown -R www-data:www-data /var/www/storage/logs

USER www-data
