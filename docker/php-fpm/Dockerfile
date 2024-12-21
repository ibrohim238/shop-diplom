FROM php:8.2-fpm-bullseye

ENV COMPOSER_MEMORY_LIMIT='-1'

RUN apt-get update
RUN apt-get install -y \
        libzip-dev \
        libz-dev \
        libzip-dev \
        libpq-dev \
        libssl-dev \
        openssh-server \
        git \
        cron \
        nano \
        libxml2-dev \
        libreadline-dev \
        libgmp-dev \
        mariadb-client \
        unzip \
        libc-client-dev \
        libkrb5-dev \
        libonig-dev \
        librdkafka-dev \
        supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install mbstring extention
RUN docker-php-ext-install mbstring && docker-php-ext-enable mbstring

# Install the PHP pcntl extention
RUN docker-php-ext-install pcntl

# Install the PHP zip extention
RUN docker-php-ext-install zip

# Install the PHP pdo_pgsql extention
RUN docker-php-ext-install pdo_pgsql

# Install the PHP bcmath extension
RUN docker-php-ext-install bcmath

# Install the PHP intl extention
RUN docker-php-ext-install intl

# Install the PHP gmp extention
RUN docker-php-ext-install gmp

# Install the PHPRedis extention
RUN pecl install redis && docker-php-ext-enable redis

#####################################
# Composer:
#####################################

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer
 \
    # Source the bash
RUN . ~/.bashrc

RUN usermod -u 1000 www-data

WORKDIR /var/www/html

EXPOSE 9000
