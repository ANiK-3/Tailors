FROM php:latest as php

RUN apt-get update -y
RUN apt-get -y install unzip libpq-dev libcurl4-gnutls-dev zlib1g-dev libzip-dev
# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql bcmath
# sockets zip mbstring exif pcntl

RUN pecl install -o -f redis \
&& rm -rf /tmp/pear \
&& docker-php-ext-enable redis

# WORKDIR /var/www
# COPY . .
RUN mkdir /app
ADD . /app
WORKDIR /app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV PORT=8000
ENTRYPOINT [ "Docker/entrypoint.sh" ]

# RUN composer install
# CMD php artisan serve --host=0.0.0.0 --port=8000
# EXPOSE 8000
