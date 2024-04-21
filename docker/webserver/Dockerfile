FROM php:8.2-apache-bullseye

ARG DEBIAN_FRONTEND=noninteractive
# Update
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y \
      git \
      zip \
      unzip

RUN a2enmod rewrite

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
