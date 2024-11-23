# Docker File
FROM php:fpm

RUN apt-get update && apt-get install -y git zip unzip \ 
    libmagickwand-dev libmagickcore-dev \
    && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev libmcrypt-dev libxml2-dev\
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php \
    && docker-php-ext-install opcache \
    && docker-php-ext-install calendar \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-configure calendar

RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

RUN git clone https://github.com/Imagick/imagick.git --depth 1 /tmp/imagick && \
    cd /tmp/imagick && \
    phpize && \
    ./configure && \
    make && \
    make install && \
    docker-php-ext-enable imagick && \
    rm -rf /tmp/imagick

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* /usr/share/man/* /usr/share/locale/*

