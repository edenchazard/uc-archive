ARG PHP_VERSION=8.2
ARG NODE_VERSION=18

# grab composer 🎶
FROM composer:latest as composer



# NODE
FROM node:${NODE_VERSION}-alpine as node-build
WORKDIR /app
# node dependencies
COPY package*.json .
RUN npm ci
# vite
COPY public ./public
COPY resources ./resources
COPY *.config.js .
RUN npm run build



FROM php:${PHP_VERSION}-fpm-alpine3.18 AS final

# files be here
WORKDIR /var/www/html
VOLUME [ "/var/www/html" ]

# necessary system packages and php extensions
RUN apk update && apk add curl-dev oniguruma-dev libxml2-dev icu-dev
RUN docker-php-ext-install curl mbstring xml pdo mysqli pdo_mysql intl
COPY .docker/php.ini /usr/local/etc/php/php.ini

# copy composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# project sauce
COPY . .

RUN  mv .env.production .env \
  && chmod -R 770 ./storage \
  && chmod -R 770 ./bootstrap/cache

# install composer dependencies
RUN composer install \
#  --ignore-platform-reqs \
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

# laravel things
RUN php artisan config:cache \
  && php artisan route:cache \
  && php artisan view:cache
  # database data
  #&& php artisan migrate:fresh --seed

# remove things we don't need and make it secure
RUN rm -rf /usr/bin/composer .docker \
  && chown -R www-data:www-data .

# switch to generic user.
USER www-data
