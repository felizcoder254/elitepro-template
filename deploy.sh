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

# 3. Check if APP_KEY exists, generate if not
if ! grep -q "^APP_KEY=base64:" .env; then
    echo "APP_KEY not found. Generating..."
    php artisan key:generate --force
    echo "✅ APP_KEY generated"
else
    echo "✅ APP_KEY already exists"
fi

# 4. Wait for PostgreSQL to be ready
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
        exit(0);
    } catch (PDOException \$e) {
        exit(1);
    }
    " 2>/dev/null; then
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
    exit 1
fi

# 5. Run database migrations (only if needed)
echo "Running database migrations..."
if php artisan migrate:status | grep -q "No"; then
    php artisan migrate --force
    echo "✅ Migrations completed"
else
    echo "✅ Migrations already up to date"
fi

# 6. Create sessions table if it doesn't exist
echo "Setting up sessions..."
if ! php artisan migrate:status | grep -q "create_sessions_table"; then
    php artisan session:table
    php artisan migrate --force
    echo "✅ Sessions table created"
else
    echo "✅ Sessions table already exists"
fi

# 7. Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 8. Link storage
php artisan storage:link

# 9. Set proper ownership
chown -R www-data:www-data storage bootstrap/cache

echo "✅ Laravel setup complete!"

# 10. Debug output
echo "=== Final Configuration ==="
echo "APP_KEY: $(grep '^APP_KEY=' .env | head -1)"
echo "APP_URL: $(grep '^APP_URL=' .env | head -1)"
echo "DB_CONNECTION: $(grep '^DB_CONNECTION=' .env | head -1)"

# 11. Start Apache in foreground
echo "=== Starting Apache web server ==="
exec apache2-foreground
