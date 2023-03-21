FROM --platform=$TARGETPLATFORM php:8.1.17-cli AS application
ARG TARGETPLATFORM
ARG TARGETARCH
ARG BUILDPLATFORM
ARG BUILDARCH

# Install required packages
RUN apt-get update && apt-get install -y --no-install-recommends \
    zip \
    unzip \
    libzip-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Additional PHP extensions and configuration
RUN docker-php-ext-install zip

# Add composer
COPY --from=composer:2.5.4 /usr/bin/composer /usr/bin/composer

# Standard production config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Custom php config
COPY docker/php/php.ini $PHP_INI_DIR/conf.d/

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Update bash profile
COPY ./docker/.profile /root/.profile
COPY ./docker/.profile /root/.bashrc
