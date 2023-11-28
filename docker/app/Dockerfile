FROM php:8.1-fpm

# install libraries
RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev supervisor \
    && docker-php-ext-install zip

RUN apt-get install -y libpq-dev libmcrypt-dev default-mysql-client libxml2 libxml2-dev

RUN docker-php-ext-install pdo_mysql pdo_pgsql soap bcmath

RUN apt-get clean

# install nodejs
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
  && apt-get install -y nodejs \
  && curl -L https://www.npmjs.com/install.sh | sh

# install composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
