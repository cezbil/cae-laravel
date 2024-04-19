FROM php:8.2-apache-bullseye

ARG DEBIAN_FRONTEND=noninteractive
# Update
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y \
      git \
      zip \
      unzip
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
