#!/bin/bash
set -e

echo "🚀 Starting Laravel build on Render..."

# Install dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Create necessary directories
echo "📁 Creating directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
echo "🔒 Setting permissions..."
chmod -R 775 storage bootstrap/cache

# Wait for PostgreSQL
echo "📊 Waiting for PostgreSQL connection..."
if [ ! -z "$DB_HOST" ]; then
    until PGPASSWORD=$DB_PASSWORD psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" -d "$DB_DATABASE" -c '\q'; do
        echo "Waiting for PostgreSQL..."
        sleep 2
    done
    echo "✅ PostgreSQL is ready!"
fi

# Run migrations
echo "🗃️ Running database migrations..."
php artisan migrate --force

# Clear cache
echo "🧹 Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo "✅ Build completed successfully!"
