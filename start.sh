#!/bin/bash

# Set strict error handling
set -e

echo "🚀 Starting Laravel 12 deployment..."

# Create necessary directories
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p database

# Set permissions
chmod -R 775 storage bootstrap/cache
chmod -R 775 database

# Create SQLite database if using SQLite
if [ "$DB_CONNECTION" = "sqlite" ]; then
    echo "📁 Setting up SQLite database..."
    touch database/database.sqlite
    chmod 666 database/database.sqlite
fi

# Check if .env exists
if [ ! -f .env ]; then
    echo "📄 Creating .env file..."
    cp .env.example .env
fi

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run database migrations
echo "🗃️ Running migrations..."
php artisan migrate --force

# Convert PORT to integer, default to 8000 if not set
PORT_INT=${PORT:-8000}
PORT_INT=$(($PORT_INT))

echo "🌐 Starting Laravel server on port $PORT_INT..."
exec php artisan serve --host=0.0.0.0 --port=$PORT_INT
