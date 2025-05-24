# grab composer 🎶
FROM composer:latest AS composer

FROM node:24.0-bookworm-slim AS node-build
WORKDIR /app
COPY --link package.json package-lock.json ./
RUN npm ci
COPY public ./public
COPY resources ./resources
COPY *.config.js .
RUN npm run build

FROM php:8.4-fpm-alpine3.21 AS build

WORKDIR /var/www

# necessary system packages and php extensions
RUN apk update && apk add curl-dev oniguruma-dev libxml2-dev icu-dev
RUN docker-php-ext-install curl mbstring xml pdo mysqli pdo_mysql intl

# copy composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock artisan ./

COPY public ./public
COPY routes ./routes
COPY database ./database
COPY config ./config
COPY app ./app
COPY storage ./storage
COPY bootstrap ./bootstrap

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

COPY --from=node-build /app/public/build ./public/build

RUN chmod -R 770 ./storage ./bootstrap/cache
RUN mkdir -p /var/www/storage/logs \
  && touch /var/www/storage/logs/laravel.log \
  && rm -rf .env .env.* \
  && chown -R www-data:www-data .

USER www-data
