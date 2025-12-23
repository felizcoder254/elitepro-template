FROM php:8.3-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    unzip \
    zip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql intl

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy app
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
