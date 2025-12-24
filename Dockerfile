# ─── Laravel with Apache & SQLite ─────────────────────────────
FROM php:8.4-apache

# 1. Install ALL system dependencies including libonig-dev
RUN apt-get update && apt-get install -y \
    git curl libzip-dev libsqlite3-dev sqlite3 \
    libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev \
    libxml2-dev libicu-dev libonig-dev \
    unzip zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
        pdo pdo_mysql pdo_sqlite \
        zip gd bcmath mbstring exif pcntl xml intl

# 3. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 4. Configure Apache
RUN a2enmod rewrite \
    && sed -ri \
        -e 's!/var/www/html!/var/www/html/public!g' \
        -e 's!AllowOverride None!AllowOverride All!g' \
        /etc/apache2/apache2.conf \
    && sed -ri \
        -e 's!/var/www/html!/var/www/html/public!g' \
        /etc/apache2/sites-available/*.conf

# 5. Set PHP configuration
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini

# 6. Set working directory and copy app
WORKDIR /var/www/html
COPY . .

# 7. Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 8. Create fresh .env file with ALL required variables
RUN rm -f .env && \
    echo "APP_NAME=Laravel" > .env && \
    echo "APP_ENV=local" >> .env && \
    echo "APP_DEBUG=true" >> .env && \
    echo "APP_URL=https://elitepro-template-1.onrender.com" >> .env && \
    echo "DB_CONNECTION=sqlite" >> .env && \
    echo "DB_DATABASE=/var/www/html/database/database.sqlite" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "MAIL_MAILER=log" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env && \
    echo "APP_KEY=" >> .env

# 9. Create SQLite database
RUN touch database/database.sqlite \
    && chmod 666 database/database.sqlite

# 10. Install Composer dependencies
RUN composer install --no-interaction --no-progress --no-suggest

# 11. Generate APP_KEY
RUN php artisan key:generate --force

# 12. Run database migrations
RUN php artisan migrate --force --no-interaction

# 13. Clear Laravel caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# 14. Create test file
RUN echo "<?php echo 'PHP is working'; ?>" > /var/www/html/public/test.php

# 15. Expose port
EXPOSE 80

# 16. Start Apache
CMD ["apache2-foreground"]
