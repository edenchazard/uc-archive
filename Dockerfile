# grab composer 🎶
FROM composer:latest AS composer

FROM node:24.0-alpine3.21 AS node

FROM php:8.4-fpm-alpine3.21 AS base
RUN apk update && apk add curl-dev oniguruma-dev libxml2-dev icu-dev libstdc++ libgcc
RUN docker-php-ext-install curl mbstring xml pdo mysqli pdo_mysql intl

FROM base AS dev
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock artisan ./

COPY routes ./routes
COPY database ./database
COPY config ./config
COPY app ./app
COPY storage ./storage
COPY bootstrap ./bootstrap
COPY public ./public
COPY resources ./resources

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

COPY package.json package-lock.json ./
RUN npm ci
COPY *.config.js .
RUN npm run build
RUN chmod -R 770 ./storage ./bootstrap/cache
RUN mkdir -p /var/www/storage/logs \
  && touch /var/www/storage/logs/laravel.log \
  && chown -R www-data:www-data .

FROM base AS prod
WORKDIR /var/www
COPY --from=dev --chown=www-data:www-data /var/www .
USER www-data
