FROM php:7.4-apache

RUN a2enmod rewrite
RUN a2enmod headers
RUN mkdir /var/www/html/data; chown www-data:www-data /var/www/html/data

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

RUN usermod -u 1000 www-data \
 && groupmod -g 1000 www-data
