#!/bin/bash

cd /var/www/html

# Setup
mkdir -p storage/framework/sessions
chmod -R 775 storage bootstrap/cache

# Generate key
php artisan key:generate --force 2>/dev/null || true

# Wait for DB
sleep 5

# Create sessions table FIRST
php artisan session:table --no-interaction 2>/dev/null || true

# Run migrations
php artisan migrate --force --no-interaction 2>/dev/null || true

# Clear and cache config
php artisan config:clear
php artisan cache:clear
php artisan config:cache

# Fix Apache document root
sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

echo "✅ Laravel with HTTPS sessions ready"
exec apache2-foreground
