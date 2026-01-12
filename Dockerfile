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
        zip gd bcmath mbstring exif pcntl xml intl

# 3. Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# 4. Configure Apache for Render
RUN a2enmod rewrite headers \
    && sed -ri \
        -e 's!/var/www/html!/var/www/html/public!g' \
        -e 's!AllowOverride None!AllowOverride All!g' \
        /etc/apache2/apache2.conf \
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

# 7. Install Composer dependencies (NO .env needed for this)
RUN composer install --no-interaction --no-progress --no-suggest --optimize-autoloader

# 8. Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 9. Create default .env from .env.example with Render settings
RUN if [ -f .env.example ]; then \
    cp .env.example .env && \
    sed -i "s|APP_URL=http://localhost|APP_URL=https://elitepro-template-1.onrender.com|g" .env && \
    sed -i "s|APP_DEBUG=true|APP_DEBUG=false|g" .env && \
    sed -i "s|SESSION_DRIVER=file|SESSION_DRIVER=database|g" .env && \
    sed -i "s|DB_CONNECTION=mysql|DB_CONNECTION=pgsql|g" .env && \
    sed -i "s|# SESSION_DOMAIN=|SESSION_DOMAIN=.onrender.com|g" .env && \
    sed -i "s|SESSION_SECURE_COOKIE=false|SESSION_SECURE_COOKIE=true|g" .env && \
    sed -i "s|SESSION_SAME_SITE=lax|SESSION_SAME_SITE=none|g" .env; \
    else \
    echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=https://elitepro-template-1.onrender.com" >> .env && \
    echo "SESSION_DRIVER=database" >> .env && \
    echo "SESSION_DOMAIN=.onrender.com" >> .env && \
    echo "SESSION_SECURE_COOKIE=true" >> .env && \
    echo "SESSION_SAME_SITE=none" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env; \
    fi

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

<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
</IfModule>
EOF

# 11. Copy deploy script
COPY deploy.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/deploy.sh

# 12. Expose port
EXPOSE 80

# 13. Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=30s --retries=3 \
  CMD curl -f http://localhost/ || exit 1

# 14. Start with deploy script
CMD ["/usr/local/bin/deploy.sh"]
