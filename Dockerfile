FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Composer dependencies
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/storage

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy entrypoint script
COPY docker/docker-php-entrypoint /usr/local/bin/

# Expose port 80 and start services
EXPOSE 80
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
