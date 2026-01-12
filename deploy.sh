#!/bin/bash
set -e

echo "=== Starting Laravel Deployment on Render ==="

# 1. Change to app directory
cd /var/www/html

# 2. Create necessary directories
echo "Creating directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
chmod -R 775 storage bootstrap/cache

# 3. Copy .env.example if .env doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file from .env.example..."
    cp .env.example .env
fi

# 4. Update .env with Render-specific settings
echo "Configuring environment..."
sed -i "s|APP_URL=.*|APP_URL=https://elitepro-template-1.onrender.com|g" .env
sed -i "s|APP_DEBUG=.*|APP_DEBUG=false|g" .env
sed -i "s|SESSION_DRIVER=.*|SESSION_DRIVER=database|g" .env

# 5. Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# 6. Wait for PostgreSQL to be ready (CRITICAL FOR RENDER)
echo "Waiting for PostgreSQL connection..."
max_attempts=30
attempt=1

while [ $attempt -le $max_attempts ]; do
    if php -r "
    try {
        \$db = new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        echo 'PostgreSQL connected successfully';
        exit(0);
    } catch (PDOException \$e) {
        exit(1);
    }
    " 2>/dev/null; then
        echo "✅ PostgreSQL is ready!"
        break
    else
        echo "Attempt $attempt/$max_attempts: PostgreSQL not ready, waiting..."
        sleep 2
        ((attempt++))
    fi
done

if [ $attempt -gt $max_attempts ]; then
    echo "❌ PostgreSQL connection failed after $max_attempts attempts"
    echo "DB_HOST: ${DB_HOST}"
    echo "DB_DATABASE: ${DB_DATABASE}"
    exit 1
fi

# 7. Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# 8. Create sessions table if using database sessions
echo "Setting up sessions..."
php artisan session:table
php artisan migrate --force

# 9. Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 10. Link storage
php artisan storage:link

# 11. Optimize for production
if [ "$APP_ENV" = "production" ]; then
    echo "Optimizing for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# 12. Set proper ownership
chown -R www-data:www-data storage bootstrap/cache

echo "✅ Deployment setup complete!"

# 13. Start Apache in foreground
echo "Starting Apache web server..."
exec apache2-foreground
