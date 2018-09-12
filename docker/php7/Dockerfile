FROM php:7-fpm
RUN apt-get update && \
    apt-get install -y --no-install-recommends git zlib1g-dev libcurl4-openssl-dev pkg-config libssl-dev unzip
RUN docker-php-ext-install pdo_mysql zip
RUN pecl install xdebug &&\
    echo "zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/ext-xdebug.ini
RUN pecl install mongodb \
    && docker-php-ext-enable xdebug \
    && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/ext-mongodb.ini
RUN curl --silent --show-error https://getcomposer.org/installer | php &&\
    mv composer.phar /usr/local/bin/composer
#COPY . /code/mediamanager_v2/
#WORKDIR /code/mediamanager_v2/
#RUN composer install --prefer-source