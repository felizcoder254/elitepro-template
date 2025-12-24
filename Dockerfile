# ─── Laravel with Apache & SQLite ─────────────────────────────
FROM php:8.4-apache

# 1. Install system dependencies and PRE-COMPILED PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev libsqlite3-dev sqlite3 libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip bcmath mbstring exif pcntl xml intl gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 3. Configure Apache
RUN a2enmod rewrite \
    && sed -ri \
        -e 's!/var/www/html!/var/www/html/public!g' \
        -e 's!AllowOverride None!AllowOverride All!g' \
        /etc/apache2/apache2.conf \
    && sed -ri \
        -e 's!/var/www/html!/var/www/html/public!g' \
        /etc/apache2/sites-available/*.conf

# 4. Set PHP configuration
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini

# 5. Set working directory and copy app
WORKDIR /var/www/html
COPY . .

# 6. Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 7. Create fresh .env file with APP_KEY placeholder
RUN rm -f .env && \
    echo "APP_NAME=Laravel" > .env && \
    echo "APP_ENV=local" >> .env && \
    echo "APP_DEBUG=true" >> .env && \
    echo "APP_URL=https://elitepro-template-1.onrender.com" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env && \
    echo "DB_DATABASE=/var/www/html/database/database.sqlite" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "APP_KEY=" >> .env  # CRITICAL: This line was missing

# 8. Create SQLite database
RUN touch database/database.sqlite \
    && chmod 666 database/database.sqlite

# 9. Install dependencies
RUN composer install --no-interaction --no-progress --no-suggest

# 10. Generate APP_KEY (CRITICAL)
RUN php artisan key:generate --force

# 11. Run migrations
RUN php artisan migrate --force --no-interaction

# 12. Clear caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# 13. Create test file
RUN echo "<?php echo 'PHP is working'; ?>" > /var/www/html/public/test.php

# 14. Expose port
EXPOSE 80

# 15. Start Apache
CMD ["apache2-foreground"]
