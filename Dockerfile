FROM php:7.4-cli-alpine as php-prod

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /.composer
COPY --from=composer:1.8.4 /usr/bin/composer /usr/bin/composer

RUN set -xe && \
    apk add --update \
        icu \
        libpng \
        libzip && \
    apk add --no-cache --virtual .php-deps \
        make && \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        zlib-dev \
        icu-dev \
        libxml2-dev \
        libzip-dev \
        libpng-dev \
        g++ && \
    (docker-php-ext-install \
        gd \
        xml \
        intl \
        opcache \
        zip &&\
         > /dev/null) && \
    composer global require "hirak/prestissimo:^0.3" "fxp/composer-asset-plugin:^1.2.0" --prefer-dist --no-progress \
        --no-suggest --optimize-autoloader --classmap-authoritative  --no-interaction -q && \
    sed -i 's/;opcache.validate_timestamps.*/opcache.validate_timestamps = 0/' /usr/local/etc/php/php.ini-production && \
    sed -i 's/;opcache.enable_cli.*/opcache.enable_cli = 1/' /usr/local/etc/php/php.ini-production && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
    apk del .build-deps && \
    rm -rf /tmp/* /usr/local/lib/php/doc/* /var/cache/apk/*

WORKDIR /app

COPY . .

ARG APP_REVISION
ENV APP_REVISION=$APP_REVISION

ARG APP_VERSION
ENV APP_VERSION=$APP_VERSION

ARG GITLAB_HANDLE_AUTH_FILE=false
ARG GITLAB_OAUTH_TOKEN

FROM php-prod as php-dev

