#!/bin/bash

# NUCLEAR: Drop and recreate sessions table
php artisan session:table
php artisan migrate:fresh --force --seed

# Clear everything
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Set proper permissions
chmod -R 775 storage

# Start Apache
exec apache2-foreground
