#!/bin/bash
# deploy.sh - Run database migrations at container startup

# Wait a moment for database to be ready
sleep 5

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Start Apache
echo "Starting Apache..."
exec apache2-foreground
