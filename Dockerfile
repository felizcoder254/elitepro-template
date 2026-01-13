#!/bin/bash
set -e

echo "=== Starting Laravel Application ==="

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file from environment variables..."
    touch .env
fi

# Ensure APP_KEY exists (CRITICAL FOR SESSIONS)
if ! grep -q "^APP_KEY=" .env || grep -q "^APP_KEY=base64:$" .env; then
    echo "APP_KEY is missing or invalid, generating..."
    # Remove any existing APP_KEY line
    grep -v "^APP_KEY=" .env > .env.tmp && mv .env.tmp .env
    # Generate new key
    php artisan key:generate --force --no-interaction
    echo "✅ APP_KEY generated"
else
    echo "✅ APP_KEY already exists"
fi

# Set proper permissions (IMPORTANT)
echo "Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
chmod -R 775 storage/framework/sessions

# Clear ALL caches before starting
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# If using database sessions, run migrations
if [ ! -z "$DB_CONNECTION" ]; then
    echo "Running database migrations..."
    php artisan migrate --force --no-interaction
fi

# Cache configurations for production
echo "Caching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verify APP_KEY is set
echo "Verifying APP_KEY:"
grep "^APP_KEY=" .env

# Start Apache
echo "✅ Starting Apache..."
exec apache2-foreground
