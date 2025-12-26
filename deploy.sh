# ─── Laravel for Render ───────────────────────────────────────────
FROM php:8.4-apache

# 1. Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libwebp-dev libxml2-dev libicu-dev libonig-dev libpq-dev \
    unzip zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
        pdo pdo_mysql pdo_pgsql \
        zip gd bcmath mbstring exif pcntl xml intl

# 3. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 4. Configure Apache
RUN a2enmod rewrite \
    && sed -ri \
        -e 's!/var/www/html!/var/www/html/public!g' \
        -e 's!AllowOverride None!AllowOverride All!g' \
        /etc/apache2/apache2.conf

# 5. PHP config
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini

# 6. Set working directory
WORKDIR /var/www/html

# 7. Copy app
COPY . .

# 8. Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 9. Create .env with Render settings
RUN echo "APP_ENV=production" > .env \
    && echo "APP_DEBUG=false" >> .env \
    && echo "APP_KEY=" >> .env \
    && echo "APP_URL=https://elitepro-template-1.onrender.com" >> .env \
    && echo "SESSION_DRIVER=database" >> .env \
    && echo "SESSION_DOMAIN=.onrender.com" >> .env \
    && echo "SESSION_SECURE_COOKIE=true" >> .env \
    && echo "SESSION_SAME_SITE=none" >> .env

# 10. Install dependencies
RUN composer install --no-interaction --no-progress --optimize-autoloader

# 11. Setup - NO SESSION:TABLE HERE - FIXED!
RUN php artisan key:generate --force \
    && mkdir -p storage/framework/sessions \
    && chown -R www-data:www-data storage \
    && chmod -R 775 storage

# 12. Create deploy script
RUN cat > /usr/local/bin/deploy.sh << 'EOF'
#!/bin/bash
echo "=== Starting Render Deployment ==="

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations (creates session table if needed)
php artisan migrate --force

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Starting Apache ==="
exec apache2-foreground
EOF

RUN chmod +x /usr/local/bin/deploy.sh

# 13. Expose port
EXPOSE 80

# 14. Start with deploy script
CMD ["/usr/local/bin/deploy.sh"]
