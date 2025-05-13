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
    if [ $APP_ENV == 'prod' ]; then \
        rm /usr/local/etc/php/conf.d/xdebug.ini; \
    else \
        pecl install xdebug-$(git ls-remote --sort='version:refname' --tags https://github.com/xdebug/xdebug.git | grep -oh "3\.1\.[0-9]" | tail -1); \
    fi

RUN if [ $APP_ENV == 'prod' ]; then \
        apt-get clean && \
        apt-get autoclean && \
        rm /var/www/web/phpinfo.php && \
        rm /var/www/web/xdebuginfo.php && \
        mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
        rm /usr/local/etc/php/php.ini-development; \
    else \
        apt-get install -y mc && \
        mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
        rm /usr/local/etc/php/php.ini-production; \
    fi

WORKDIR /var/www

ADD .etc/apache2 /etc/apache2
ADD .etc/php /usr/local/etc/php
ADD . /var/www
RUN rm -R /var/www/.etc

RUN if [ $APP_ENV == 'prod' ]; then \
        sed -i -E 's/\$\{PHP_OPCACHE_VALIDATE_TIMESTAMPS\}/0/g' /usr/local/etc/php/conf.d/opcache.ini; \
    else \
        sed -i -E 's/\$\{PHP_OPCACHE_VALIDATE_TIMESTAMPS\}/1/g' /usr/local/etc/php/conf.d/opcache.ini; \
    fi

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN if [ $APP_ENV == 'prod' ]; then \
        composer install --optimize-autoloader; \
    else \
        composer install; \
    fi

RUN chmod 0777 /var/www/var/log /var/www/var/twig_cache /var/www/web/uploads

RUN a2dissite 000-default && \
    a2ensite news-local && \
    a2ensite news-prod

ENV PATH "$PATH:/var/www/vendor/bin"
