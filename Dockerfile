# ─── Stage 1: Build Frontend Assets (if needed) ─────────────────
# Skip this stage if your project doesn't use Vite/Node.js
FROM node:18-alpine AS frontend

WORKDIR /app

# Copy package files for better caching
COPY package*.json ./
RUN npm ci --only=production

# Copy source and build
COPY . .
RUN npm run build 2>/dev/null || echo "No build script, continuing..."

# ─── Stage 2: Runtime (PHP + Apache) ───────────────────────────
FROM php:8.3-apache

# 1. Install system dependencies
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
    unzip \
    zip \
    # Optional: Add Node.js if you need it at runtime
    # nodejs \
    # npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
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
        intl

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
# Copy built assets from frontend stage (if you use it)
# COPY --from=frontend /app/public/build ./public/build/

# 8. Install PHP dependencies (handles PHP version mismatch)
RUN if [ -f composer.lock ]; then \
        composer install --no-dev --optimize-autoloader --no-interaction; \
    else \
        composer update --no-dev --optimize-autoloader --no-interaction; \
    fi

# 9. Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# 10. Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# 11. Expose port
EXPOSE 80

# 12. Start Apache
CMD ["apache2-foreground"]
