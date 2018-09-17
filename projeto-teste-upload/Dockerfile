FROM php:7.2.8-apache
WORKDIR /var/www/html

RUN apt-get update
RUN apt-get install libpq-dev -y
RUN apt-get install -y wget git-core
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y zlib1g-dev \
    && docker-php-ext-install zip

RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN echo "include_path = \".:/var/www/html/includes\"" > /usr/local/etc/php/conf.d/personalizado.ini
RUN echo "error_reporting = E_ALL & ~E_WARNING & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE" >> /usr/local/etc/php/conf.d/personalizado.ini
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_DOCUMENT_ROOT /var/www/html

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

CMD /usr/sbin/apache2ctl -D FOREGROUND
