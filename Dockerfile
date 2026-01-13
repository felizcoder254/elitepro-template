# ─── Laravel with Apache & PostgreSQL ─────────────────────────────
FROM php:8.4-apache

# 1. Install system dependencies including PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libwebp-dev libxml2-dev libicu-dev libonig-dev libpq-dev \
    postgresql-client unzip zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
        pdo pdo_mysql pdo_pgsql \
        zip gd bcmath mbstring exif pcntl xml intl opcache

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Configure Apache for Laravel
RUN a2enmod rewrite headers \
    && echo "<VirtualHost *:80>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html/public\n\
    \n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
        FallbackResource /index.php\n\
    </Directory>\n\
    \n\
    ErrorLog \${APACHE_LOG_DIR}/error.log\n\
    CustomLog \${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 5. Set PHP configuration for Render
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_input_time = 300" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "session.save_path = /tmp" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.interned_strings_buffer=32" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.max_accelerated_files=32531" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/custom.ini

# 6. Set working directory and copy app
WORKDIR /var/www/html
COPY . .

# 7. Create necessary directories and set permissions BEFORE composer install
RUN mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 8. Install Composer dependencies (run as www-data to avoid permission issues)
USER www-data
RUN composer install --no-interaction --no-progress --no-suggest --optimize-autoloader --no-dev
USER root

# 9. Create .htaccess for Apache
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

# 10. Create entrypoint script
RUN cat > /usr/local/bin/entrypoint.sh << 'EOF'
#!/bin/bash
set -e

echo "=== Laravel Application Startup ==="

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file..."
    
    # Start with required Laravel variables
    touch .env
    
    # Add APP_KEY from environment if exists
    if [ ! -z "$APP_KEY" ]; then
        echo "APP_KEY=$APP_KEY" >> .env
    else
        echo "⚠️  APP_KEY not found in environment"
    fi
    
    # Add other common environment variables
    [ ! -z "$APP_NAME" ] && echo "APP_NAME=$APP_NAME" >> .env
    [ ! -z "$APP_ENV" ] && echo "APP_ENV=$APP_ENV" >> .env
    [ ! -z "$APP_DEBUG" ] && echo "APP_DEBUG=$APP_DEBUG" >> .env
    [ ! -z "$APP_URL" ] && echo "APP_URL=$APP_URL" >> .env
    [ ! -z "$LOG_CHANNEL" ] && echo "LOG_CHANNEL=$LOG_CHANNEL" >> .env
    
    # Database configuration
    [ ! -z "$DB_CONNECTION" ] && echo "DB_CONNECTION=$DB_CONNECTION" >> .env
    [ ! -z "$DB_HOST" ] && echo "DB_HOST=$DB_HOST" >> .env
    [ ! -z "$DB_PORT" ] && echo "DB_PORT=$DB_PORT" >> .env
    [ ! -z "$DB_DATABASE" ] && echo "DB_DATABASE=$DB_DATABASE" >> .env
    [ ! -z "$DB_USERNAME" ] && echo "DB_USERNAME=$DB_USERNAME" >> .env
    [ ! -z "$DB_PASSWORD" ] && echo "DB_PASSWORD=$DB_PASSWORD" >> .env
    
    # Session configuration
    [ ! -z "$SESSION_DRIVER" ] && echo "SESSION_DRIVER=$SESSION_DRIVER" >> .env
    [ ! -z "$SESSION_LIFETIME" ] && echo "SESSION_LIFETIME=$SESSION_LIFETIME" >> .env
    [ ! -z "$SESSION_ENCRYPT" ] && echo "SESSION_ENCRYPT=$SESSION_ENCRYPT" >> .env
    [ ! -z "$SESSION_SECURE_COOKIE" ] && echo "SESSION_SECURE_COOKIE=$SESSION_SECURE_COOKIE" >> .env
    
    echo "✅ .env file created"
else
    echo "✅ .env file already exists"
fi

# Ensure APP_KEY is set
if ! grep -q "^APP_KEY=base64:" .env; then
    echo "APP_KEY is missing or invalid"
    
    # Check if we have APP_KEY in environment
    if [ ! -z "$APP_KEY" ]; then
        echo "Using APP_KEY from environment..."
        # Remove any existing APP_KEY line
        grep -v "^APP_KEY=" .env > .env.tmp && mv .env.tmp .env
        echo "APP_KEY=$APP_KEY" >> .env
    else
        echo "Generating new APP_KEY..."
        php artisan key:generate --force --no-interaction
    fi
else
    echo "✅ APP_KEY is already set"
fi

# Set permissions
echo "Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Wait for PostgreSQL if needed
if [ ! -z "$DB_CONNECTION" ] && [ "$DB_CONNECTION" = "pgsql" ] && [ ! -z "$DB_HOST" ]; then
    echo "Checking PostgreSQL connection..."
    if command -v pg_isready &> /dev/null; then
        until pg_isready -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME"; do
            echo "Waiting for PostgreSQL..."
            sleep 2
        done
        echo "✅ PostgreSQL is ready!"
    fi
fi

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Cache for production
echo "Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Application is ready!"
echo "Starting Apache..."

# Start Apache in foreground
exec apache2-foreground
EOF

RUN chmod +x /usr/local/bin/entrypoint.sh

# 11. Expose port
EXPOSE 80

# 12. Start with entrypoint script
CMD ["/usr/local/bin/entrypoint.sh"]
