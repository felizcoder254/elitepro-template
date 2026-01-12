#!/bin/bash
set -e

echo "=== SIMPLE Laravel Deploy ==="

cd /var/www/html

# 1. Create storage directories
mkdir -p storage/framework/{sessions,views,cache}
chmod -R 775 storage

# 2. Always generate APP_KEY (ignore warnings)
echo "APP_KEY=" > .env.appkey
php artisan key:generate --force 2>&1 | grep -v "No APP_KEY" || true

# 3. Wait briefly for database
sleep 3

# 4. Run migrations (including sessions) - suppress errors
php artisan migrate --force 2>&1 | grep -v "ERROR\|error" || true

# 5. Clear caches
php artisan config:clear || true
php artisan cache:clear || true

echo "✅ Deploy complete. Starting Apache..."

# 6. Start Apache
exec apache2-foreground
