# ─── Laravel with Apache & PostgreSQL for Render.com ─────────────────────────
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

# 4. Configure Apache for Render (LISTEN ON DYNAMIC PORT)
RUN a2enmod rewrite headers

# 5. Set PHP configuration
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "session.save_path = /var/lib/php/sessions" >> /usr/local/etc/php/conf.d/custom.ini

# 6. Set working directory
WORKDIR /var/www/html

# 7. Copy application files
COPY . .

# 8. Install dependencies
RUN composer install --no-interaction --no-progress --optimize-autoloader --no-dev

# 9. Create entrypoint script for Render
RUN cat > /entrypoint.sh << 'EOF'
#!/bin/bash
set -e

echo "🚀 Starting Laravel on Render..."

# Wait for PostgreSQL if needed
if [ "$DB_CONNECTION" = "pgsql" ] && [ -n "$DB_HOST" ]; then
    echo "📊 Waiting for PostgreSQL..."
    while ! pg_isready -h $DB_HOST -p $DB_PORT -U $DB_USERNAME; do
        sleep 2
    done
    echo "✅ PostgreSQL connected"
fi

# Create .env from environment variables
cat > .env << ENVFILE
APP_NAME="${APP_NAME:-Laravel}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL:-https://elitepro-template-1.onrender.com}"

LOG_CHANNEL="${LOG_CHANNEL:-stack}"
LOG_LEVEL="${LOG_LEVEL:-debug}"

DB_CONNECTION="${DB_CONNECTION:-pgsql}"
DB_HOST="${DB_HOST}"
DB_PORT="${DB_PORT:-5432}"
DB_DATABASE="${DB_DATABASE}"
DB_USERNAME="${DB_USERNAME}"
DB_PASSWORD="${DB_PASSWORD}"

SESSION_DRIVER="${SESSION_DRIVER:-file}"
SESSION_LIFETIME="${SESSION_LIFETIME:-120}"
SESSION_ENCRYPT="${SESSION_ENCRYPT:-false}"
SESSION_SECURE_COOKIE="${SESSION_SECURE_COOKIE:-true}"
SESSION_DOMAIN="${SESSION_DOMAIN:-.onrender.com}"

CACHE_DRIVER="${CACHE_DRIVER:-file}"
QUEUE_CONNECTION="${QUEUE_CONNECTION:-sync}"
ENVFILE

# Verify APP_KEY exists
if ! grep -q "APP_KEY=base64:" .env; then
    echo "⚠️  Generating APP_KEY..."
    php artisan key:generate --force --no-interaction
fi

# Run migrations
echo "🗃️ Running migrations..."
php artisan migrate --force --no-interaction

# Setup sessions if using database driver
if [ "$SESSION_DRIVER" = "database" ]; then
    echo "💾 Setting up database sessions..."
    php artisan session:table --no-interaction
    php artisan migrate --force --no-interaction
fi

# Clear cache
echo "🧹 Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Fix permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Configure Apache for Render's dynamic port
echo "🔧 Configuring Apache for port \$PORT..."
sed -i "s/Listen 80/Listen \$PORT/g" /etc/apache2/ports.conf
sed -i "s/:80/:\$PORT/g" /etc/apache2/sites-available/*.conf

echo "✅ Ready! Starting Apache..."
exec apache2-foreground
EOF

RUN chmod +x /entrypoint.sh

# 10. Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 11. Expose port (Render will override this)
EXPOSE 80

# 12. Use entrypoint script
CMD ["/entrypoint.sh"]
