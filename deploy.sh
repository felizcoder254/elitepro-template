#!/bin/bash
set -e

echo "=== Starting Laravel Deployment on Render ==="

# 1. Change to app directory
cd /var/www/html

# 2. Create a lock file to prevent running twice
LOCKFILE="/tmp/deploy.lock"
if [ -f "$LOCKFILE" ]; then
    echo "Deployment already in progress. Exiting."
    exit 0
fi
touch "$LOCKFILE"
trap "rm -f $LOCKFILE" EXIT

# 3. Create necessary directories
echo "Creating directories..."
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
chmod -R 775 storage bootstrap/cache

# 4. Generate APP_KEY if not exists (force generate)
echo "Generating APP_KEY..."
if grep -q "^APP_KEY=base64:" .env; then
    echo "✅ APP_KEY already exists"
else
    # Create a temporary .env with APP_KEY placeholder
    if ! grep -q "^APP_KEY=" .env; then
        echo "APP_KEY=" >> .env
    fi
    # Generate the key
    php artisan key:generate --force --no-interaction 2>/dev/null || true
    echo "✅ APP_KEY generated"
fi

# 5. Wait for PostgreSQL to be ready
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

# 6. Run database migrations
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# 7. Create sessions table (run session:table and migrate if needed)
echo "Setting up sessions..."
# Check if sessions migration exists in migrations table
if php -r "
require 'vendor/autoload.php';
\$app = require_once 'bootstrap/app.php';
\$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

if (!Schema::hasTable('migrations')) {
    echo 'no_migrations_table';
    exit(0);
}

\$migration = DB::table('migrations')->where('migration', 'like', '%create_sessions_table%')->first();
echo \$migration ? 'exists' : 'not_exists';
" | grep -q "not_exists" || grep -q "no_migrations_table"; then
    echo "Creating sessions table..."
    php artisan session:table --no-interaction
    php artisan migrate --force --no-interaction
    echo "✅ Sessions table created"
else
    echo "✅ Sessions table already exists"
fi

# 8. Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 9. Link storage
php artisan storage:link --no-interaction

# 10. Set proper ownership
chown -R www-data:www-data storage bootstrap/cache

# 11. Optimize for production
if [ "$APP_ENV" = "production" ]; then
    echo "Optimizing for production..."
    php artisan config:cache --no-interaction
    php artisan route:cache --no-interaction
    php artisan view:cache --no-interaction
fi

echo "✅ Laravel setup complete!"

# 12. Debug output
echo "=== Final Configuration ==="
echo "APP_ENV: ${APP_ENV}"
echo "APP_DEBUG: ${APP_DEBUG}"
echo "DB_CONNECTION: ${DB_CONNECTION}"

# 13. Start Apache in foreground
echo "=== Starting Apache web server ==="
exec apache2-foreground
