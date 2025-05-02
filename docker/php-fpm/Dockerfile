FROM php:8.2-fpm-bullseye

ENV COMPOSER_MEMORY_LIMIT='-1'

WORKDIR /var/www
COPY . /var/www

ARG WWWUSER
ARG WWWGROUP

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libxpm-dev \
    libwebp-dev \
    libmcrypt-dev \
    zlib1g-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libsodium-dev \
    librdkafka-dev \
    libmagickwand-dev --no-install-recommends \
    supervisor # require for queue

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#####################################
# php extensions:
#####################################

# Install the imagick extention
RUN pecl install imagick && docker-php-ext-enable imagick # require for dev
# Install the PHPRedis extention
RUN pecl install redis && docker-php-ext-enable redis
# Install the PHP zip extention
RUN docker-php-ext-install zip
# Install the PHP pcntl extention
RUN docker-php-ext-install pcntl # require for dev
# Install the PHP mbstring extention
RUN docker-php-ext-install mbstring
# Install the PHP sodium extention
RUN docker-php-ext-install sodium
# Install the PHP exif extention
RUN docker-php-ext-install exif
# Install the PHP bcmath extention
RUN docker-php-ext-install bcmath
# Install the PHP pdo_pgsql extention
RUN docker-php-ext-install pdo_pgsql

# Install the PHP intl extention
RUN docker-php-ext-install intl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install gd

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

# Копируем скрипт и даём ему право на исполнение
COPY docker/php-fpm/adjust_ids.sh /usr/local/bin/adjust_ids.sh
RUN chmod +x /usr/local/bin/adjust_ids.sh

# Запускаем его во время билда
RUN /usr/local/bin/adjust_ids.sh

EXPOSE 9000

# Переключаемся на непривилегированного пользователя
USER www-data
