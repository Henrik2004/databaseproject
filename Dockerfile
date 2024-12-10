FROM php:8.0-apache

# Install MySQL client
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    mariadb-client \
    sed \
    systemctl

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Composer (if your project uses it)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy your project files
COPY . /var/www/html

# Set permissions (if necessary)
RUN chown -R www-data:www-data /var/www/html

RUN sed -i 's/display_errors = On/display_errors = Off/g' /usr/local/etc/php/php.ini-production
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN chmod 644 /usr/local/etc/php/php.ini

RUN PHPRC=/usr/local/etc/php

RUN pecl install redis && docker-php-ext-enable redis

# Restart Apache
RUN systemctl restart apache2

# Expose port 80 for web access
EXPOSE 80