#!/bin/bash
# deploy.sh - Render-optimized deployment script

echo "=== Starting Render Deployment ==="

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Apply Render-specific environment overrides
echo "Applying Render-specific configurations..."

# Force Render-compatible session settings
php artisan env:set SESSION_DRIVER database --no-interaction 2>/dev/null || true
php artisan env:set SESSION_DOMAIN .onrender.com --no-interaction 2>/dev/null || true
php artisan env:set SESSION_SAME_SITE none --no-interaction 2>/dev/null || true
php artisan env:set SESSION_SECURE_COOKIE true --no-interaction 2>/dev/null || true
php artisan env:set TRUSTED_PROXIES '*' --no-interaction 2>/dev/null || true

# Run migrations for session table
echo "Setting up database sessions..."
php artisan migrate --force

# Create session directory if missing
mkdir -p storage/framework/sessions
chmod 775 storage/framework/sessions

# Optimize for production
echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix Apache ServerName warning
echo "ServerName localhost" >> /etc/apache2/apache2.conf

echo "=== Starting Apache Server ==="
exec apache2-foreground
