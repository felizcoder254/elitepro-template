# WORKING Dockerfile for Laravel on Render
FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev libicu-dev libonig-dev unzip zip \
    && apt-get clean

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd bcmath mbstring xml intl

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Configure Apache
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy app
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Create .env with Render settings
RUN echo "APP_ENV=production" > .env \
    && echo "APP_DEBUG=false" >> .env \
    && echo "APP_KEY=" >> .env \
    && echo "APP_URL=https://elitepro-template-1.onrender.com" >> .env \
    && echo "SESSION_DRIVER=database" >> .env \
    && echo "SESSION_DOMAIN=.onrender.com" >> .env \
    && echo "SESSION_SECURE_COOKIE=true" >> .env \
    && echo "SESSION_SAME_SITE=none" >> .env

# Install dependencies
RUN composer install --no-interaction --no-progress --optimize-autoloader

# Generate key and setup - NO SESSION:TABLE HERE
RUN php artisan key:generate --force \
    && mkdir -p storage/framework/sessions \
    && chmod 775 storage

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
