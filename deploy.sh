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

# 3. Generate application key if not set
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# 4. Wait for PostgreSQL to be ready (CRITICAL FOR RENDER)
echo "Waiting for PostgreSQL connection..."
max_attempts=30
attempt=1

while [ $attempt -le $max_attempts ]; do
    if php -r "
    \$host = getenv('DB_HOST') ?: 'localhost';
    \$port = getenv('DB_PORT') ?: '5432';
    \$dbname = getenv('DB_DATABASE') ?: 'postgres';
    \$username = getenv('DB_USERNAME') ?: 'postgres';
    \$password = getenv('DB_PASSWORD') ?: '';
    
    try {
        \$dsn = 'pgsql:host=' . \$host . ';port=' . \$port . ';dbname=' . \$dbname;
        \$db = new PDO(\$dsn, \$username, \$password);
        \$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'PostgreSQL connected successfully';
        exit(0);
    } catch (PDOException \$e) {
        echo 'Connection failed: ' . \$e->getMessage();
        exit(1);
    }
    "; then
        echo "✅ PostgreSQL is ready!"
        break
    else
        echo "Attempt $attempt/$max_attempts: PostgreSQL not ready, waiting..."
        sleep 3
        ((attempt++))
    fi
done

if [ $attempt -gt $max_attempts ]; then
    echo "❌ PostgreSQL connection failed after $max_attempts attempts"
    echo "Debug info:"
    echo "DB_HOST: ${DB_HOST}"
    echo "DB_PORT: ${DB_PORT}"
    echo "DB_DATABASE: ${DB_DATABASE}"
    echo "DB_USERNAME: ${DB_USERNAME}"
    exit 1
fi

# 5. Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# 6. Create sessions table
echo "Setting up sessions..."
php artisan session:table
php artisan migrate --force

# 7. Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 8. Link storage
php artisan storage:link

# 9. Set production optimizations
if [ "$APP_ENV" = "production" ] || [ "$APP_ENV" = "Production" ]; then
    echo "Optimizing for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# 10. Set proper ownership
chown -R www-data:www-data storage bootstrap/cache

echo "✅ Laravel setup complete!"

# 11. Debug output
echo "=== Debug Information ==="
echo "APP_ENV: ${APP_ENV}"
echo "APP_URL: ${APP_URL}"
echo "DB_CONNECTION: ${DB_CONNECTION}"
echo "DB_HOST: ${DB_HOST}"
echo "Session Driver: $(php artisan tinker --execute='echo config(\"session.driver\");')"

# 12. Start Apache in foreground
echo "=== Starting Apache web server ==="
exec apache2-foreground
