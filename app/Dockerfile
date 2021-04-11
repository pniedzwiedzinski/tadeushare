FROM php:7-fpm-alpine

# Update system core
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev
RUN docker-php-ext-install pgsql mysqli && docker-php-ext-enable mysqli pgsql

# Start PHP-FPM
CMD ["php-fpm"]
