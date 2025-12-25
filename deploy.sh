#!/bin/bash
# deploy.sh

# Wait for database
sleep 5

# Create sessions table if it doesn't exist
echo "Checking for sessions table..."
if ! php artisan tinker --execute="echo \Illuminate\Support\Facades\Schema::hasTable('sessions') ? 'YES' : 'NO';" | grep -q "YES"; then
    echo "Creating sessions table..."
    php artisan session:table
    php artisan migrate --force --no-interaction
fi

# Run all migrations (including sessions if not exists)
php artisan migrate --force --no-interaction

# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Start Apache
exec apache2-foreground
