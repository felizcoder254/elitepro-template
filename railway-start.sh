#!/bin/bash

set -e

echo "Setting up Laravel application..."

# Create the SQLite database file if it doesn't exist
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    chmod 666 database/database.sqlite
fi

# Create .env if not exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    php artisan key:generate --force
fi

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run migrations
php artisan migrate --force

echo "Starting PHP built-in server on port $PORT..."

# Start PHP built-in server
php -S 0.0.0.0:$PORT -t public
