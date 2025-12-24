# ─── Laravel with Apache & SQLite ─────────────────────────────
FROM php:8.4-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev \
    libwebp-dev libzip-dev libpq-dev libxml2-dev libonig-dev \
    libicu-dev unzip zip sqlite3 libsqlite3-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        pdo pdo_mysql pdo_pgsql pdo_sqlite \
        zip gd bcmath mbstring exif pcntl xml opcache intl

# 3. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 4. Configure Apache
RUN a2enmod rewrite headers \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf \
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

# 7. Set proper permissions (early for proper file operations)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# 8. Create SQLite database file if using SQLite
RUN if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then \
    touch database/database.sqlite; \
    chown www-data:www-data database/database.sqlite; \
    chmod 666 database/database.sqlite; \
    echo "SQLite database file created"; \
    fi

# 9. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# 10. Generate APP_KEY if not provided (CRITICAL FIX)
RUN if [ -z "${APP_KEY}" ] || [ "${APP_KEY}" = "base64:" ]; then \
    php artisan key:generate --show > /tmp/app_key.txt; \
    export APP_KEY=$(cat /tmp/app_key.txt); \
    echo "APP_KEY=${APP_KEY}" >> .env; \
    echo "Generated new APP_KEY"; \
    else \
    echo "APP_KEY=${APP_KEY}" >> .env; \
    fi

# 11. Complete .env setup
RUN echo "APP_NAME=\"${APP_NAME:-Laravel}\"" >> .env \
    && echo "APP_ENV=${APP_ENV:-production}" >> .env \
    && echo "APP_DEBUG=${APP_DEBUG:-false}" >> .env \
    && echo "APP_URL=${APP_URL:-http://localhost}" >> .env \
    && echo "DB_CONNECTION=${DB_CONNECTION:-sqlite}" >> .env \
    && echo "DB_DATABASE=${DB_DATABASE:-database/database.sqlite}" >> .env

# 12. Run database migrations only if SQLite database exists
RUN if [ -f database/database.sqlite ] && [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then \
    echo "Running migrations..."; \
    php artisan migrate --force --no-interaction; \
    else \
    echo "Skipping migrations (no SQLite database found)"; \
    fi

# 13. Clear Laravel cache (FIXED - no database dependency)
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# 14. Optimize for production
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# 15. Expose port
EXPOSE 80

# 16. Start Apache
CMD ["apache2-foreground"]

# Add this BEFORE the caching commands
RUN php artisan route:clear

# Then run your caching commands
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache
