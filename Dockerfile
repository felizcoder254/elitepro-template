# ─── Stage 1: Runtime (PHP + Apache) ───────────────────────────
FROM php:8.3-apache

# 1. Install system dependencies WITH ICU libraries
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    libpq-dev \
    libxml2-dev \
    libonig-dev \
    libicu-dev \           # ← ADD THIS LINE for intl extension
    unzip \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-configure intl \  # ← ADD THIS LINE to configure intl
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        zip \
        gd \
        bcmath \
        mbstring \
        exif \
        pcntl \
        xml \
        opcache \
        intl             # This will now work with libicu-dev installed

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

# 6. Set working directory
WORKDIR /var/www/html

# 7. Copy application files
COPY . .

# 8. Install PHP dependencies
RUN if [ -f composer.lock ]; then \
        composer install --no-dev --optimize-autoloader --no-interaction; \
    else \
        composer update --no-dev --optimize-autoloader --no-interaction; \
    fi

# 9. Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# 10. Expose port
EXPOSE 80

# 11. Start Apache
CMD ["apache2-foreground"]
