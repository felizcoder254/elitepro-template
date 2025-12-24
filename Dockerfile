# ─── Laravel with Apache & SQLite ─────────────────────────────
FROM php:8.4-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev libsqlite3-dev sqlite3 \
    && docker-php-ext-install pdo pdo_sqlite zip \
    && a2enmod rewrite

# 2. Set Apache to serve from public directory
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf

# 3. Set working directory and copy app
WORKDIR /var/www/html
COPY . .

# 4. Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 5. Create SQLite database
RUN touch database/database.sqlite \
    && chmod 666 database/database.sqlite

# 6. Create .env from example or create minimal one
RUN if [ -f .env.example ]; then \
        cp .env.example .env; \
    else \
        echo "APP_ENV=local" > .env; \
        echo "APP_DEBUG=true" >> .env; \
        echo "APP_URL=https://elitepro-template-1.onrender.com" >> .env; \
        echo "DB_CONNECTION=sqlite" >> .env; \
        echo "SESSION_DRIVER=file" >> .env; \
        echo "CACHE_DRIVER=file" >> .env; \
    fi

# 7. Install dependencies
RUN composer install --no-interaction --no-progress --no-suggest

# 8. Generate APP_KEY - This will add it to .env
RUN php artisan key:generate --force

# 9. Run migrations
RUN php artisan migrate --force --no-interaction

# 10. Create test file
RUN echo "<?php echo 'PHP is working'; ?>" > /var/www/html/public/test.php

# 11. Expose port
EXPOSE 80

# 12. Start Apache
CMD ["apache2-foreground"]
