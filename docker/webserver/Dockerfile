FROM php:8.2-apache-bullseye

ARG DEBIAN_FRONTEND=noninteractive
# Update
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y \
      git \
      zip \
      unzip

RUN apt-get --no-install-recommends install -y libldap2-dev && \
    pecl install xdebug && \
    docker-php-ext-install ldap && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-enable ldap && \
    docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
