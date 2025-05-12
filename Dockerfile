FROM php:7.4-apache

ARG APP_ENV='dev'

ENV APP_ENV=$APP_ENV

RUN apt-get update && \
    apt-get install -y \
        bzip2 \
        ca-certificates \
        curl \
        gettext \
        git \
        libtool \
        tzdata \
        unzip \
        zip

RUN docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-enable opcache

RUN if [ $APP_ENV == 'prod' ]; then \
        apt-get clean && \
        apt-get autoclean && \
        rm /var/www/web/phpinfo.php && \
        mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
        rm /usr/local/etc/php/php.ini-development; \
    else \
        apt-get install -y mc && \
        mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
        rm /usr/local/etc/php/php.ini-production; \
    fi

WORKDIR /var/www

ADD .etc/apache2 /etc/apache2
ADD . /var/www
RUN rm -R /var/www/.etc

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN if [ $APP_ENV == 'prod' ]; then \
        composer install --optimize-autoloader; \
    else \
        composer install; \
    fi

RUN a2dissite 000-default && \
    a2ensite news-local && \
    a2ensite news-prod

