#!/bin/bash

# Create necessary directories
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p database/database

# Set permissions (not always needed on Railway but good practice)
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Check if .env exists
if [ ! -f .env ]; then
    echo "Creating .env file from .env.example"
    cp .env.example .env
fi

# Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate
fi

# Create SQLite database file if using SQLite
if [ "$DB_CONNECTION" = "sqlite" ] && [ ! -f "$DB_DATABASE" ]; then
    echo "Creating SQLite database..."
    touch "$DB_DATABASE"
    chmod 755 "$DB_DATABASE"
fi

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Link storage
php artisan storage:link

# Run migrations
php artisan migrate --force

echo "✅ Deployment setup complete!"