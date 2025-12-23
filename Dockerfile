# Use an official PHP image with Apache
FROM php:8.3-apache

# Install system dependencies, Node.js, and Composer
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP dependencies, generate the application key, and build assets
RUN composer install --no-dev --optimize-autoloader \
    && php artisan key:generate \
    && npm install \
    && npm run build

# Set proper permissions for Laravel storage and bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Expose port 80 and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
