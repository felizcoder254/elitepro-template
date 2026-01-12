# ─── Laravel with Apache & PostgreSQL ─────────────────────────────
FROM php:8.4-apache

# 1. Install system dependencies including PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libwebp-dev libxml2-dev libicu-dev libonig-dev libpq-dev \
    unzip zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
        pdo pdo_mysql pdo_pgsql \
        zip gd bcmath mbstring exif pcntl xml

# 3. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 4. Configure Apache for Laravel (FIXED)
RUN a2enmod rewrite headers \
    && echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options Indexes FollowSymLinks\n\
    </Directory>\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 5. Set PHP configuration for Render
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "session.save_path = /tmp" >> /usr/local/etc/php/conf.d/custom.ini

# 6. Set working directory and copy app
WORKDIR /var/www/html
COPY . .

# 7. Install Composer dependencies
RUN composer install --no-interaction --no-progress --no-suggest --optimize-autoloader

# 8. Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 9. Create minimal .env file
RUN echo "APP_NAME=Laravel" > .env \
    && echo "APP_ENV=production" >> .env \
    && echo "APP_DEBUG=false" >> .env \
    && echo "APP_URL=https://elitepro-template-1.onrender.com" >> .env \
    && echo "LOG_CHANNEL=stderr" >> .env \
    && echo "DB_CONNECTION=pgsql" >> .env \
    && echo "SESSION_DRIVER=database" >> .env

# 10. Create .htaccess for Apache
RUN cat > public/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
EOF

# 11. Copy deploy script
COPY deploy.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/deploy.sh

# 12. Expose port
EXPOSE 80

# 13. Start with deploy script
CMD ["/usr/local/bin/deploy.sh"]
