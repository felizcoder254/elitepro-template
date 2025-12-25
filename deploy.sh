#!/bin/bash
# deploy.sh

# Wait for database
sleep 3

# Clear old sessions to prevent CSRF conflicts
echo "Clearing old sessions..."
php artisan session:flush

# Run migrations
php artisan migrate --force --no-interaction

# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Set proper permissions for sessions
chmod -R 775 storage/framework/sessions

# Start Apache
exec apache2-foreground
