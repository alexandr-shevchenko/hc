FROM php:7.3.5-fpm-alpine AS build

RUN apk upgrade --update && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo_pgsql

# Install composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

# Cleanup
RUN rm -rf /var/cache/apk/* \
    && find / -type f -iname \*.apk-new -delete \
    && rm -rf /var/cache/apk/*

ADD php.ini /usr/local/etc/php/php.ini

EXPOSE 9000

CMD ["php-fpm"]