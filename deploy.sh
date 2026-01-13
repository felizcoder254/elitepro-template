#!/bin/bash
set -e

echo "=== Starting Laravel Deployment on Render ==="

# Create necessary directories
echo "Creating directories..."
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p bootstrap/cache

# Check if APP_KEY exists in environment variables
if [ ! -z "$APP_KEY" ]; then
    echo "✅ APP_KEY found in environment variables"
    
    # Create or update .env file
    if [ ! -f .env ]; then
        echo "Creating .env file..."
        touch .env
    fi
    
    # Update APP_KEY in .env
    if grep -q "^APP_KEY=" .env; then
        # Update existing APP_KEY
        sed -i "s|^APP_KEY=.*|APP_KEY=$APP_KEY|" .env
    else
        # Add APP_KEY if not exists
        echo "APP_KEY=$APP_KEY" >> .env
    fi
else
    echo "⚠️  APP_KEY not found in environment variables, generating..."
    # Remove existing APP_KEY line if empty
    sed -i '/^APP_KEY=$/d' .env
    # Generate new key
    php artisan key:generate --force --no-interaction
fi

# Wait for PostgreSQL if using it
if [ ! -z "$DB_CONNECTION" ] && [ "$DB_CONNECTION" = "pgsql" ]; then
    echo "Waiting for PostgreSQL connection..."
    until pg_isready -h $DB_HOST -p $DB_PORT -U $DB_USERNAME; do
        echo "Waiting for PostgreSQL..."
        sleep 2
    done
    echo "✅ PostgreSQL is ready!"
fi

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# Set up sessions if using database sessions
if [ ! -z "$SESSION_DRIVER" ] && [ "$SESSION_DRIVER" = "database" ]; then
    echo "Setting up sessions..."
    # Check if sessions table migration exists
    if [ ! -f database/migrations/*_create_sessions_table.php ]; then
        echo "Creating sessions table migration..."
        php artisan session:table --no-interaction
    fi
    # Run migration for sessions
    php artisan migrate --force --no-interaction
fi

# Clear and cache configurations
echo "Caching configurations..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix permissions
echo "Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "✅ Deployment completed successfully!"
