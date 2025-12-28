#!/bin/bash

# Generate the session table migration if it doesn't exist
php artisan session:table

# Run pending migrations
php artisan migrate --force

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Set proper permissions
chmod -R 775 storage

# Start Apache
exec apache2-foreground
