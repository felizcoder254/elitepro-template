# 1. Create .env first
RUN echo "APP_NAME=Laravel" > .env \
    && echo "APP_ENV=local" >> .env \
    && echo "APP_DEBUG=true" >> .env \
    && echo "APP_URL=http://localhost" >> .env

# 2. Install dependencies
RUN composer install --no-interaction

# 3. Generate APP_KEY
RUN php artisan key:generate --force

# 4. Add test routes to web.php (do this locally first)
# 5. Clear ALL caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan cache:clear

# 6. Run migrations if needed
RUN touch database/database.sqlite \
    && php artisan migrate --force --no-interaction

# 7. Cache for production (optional)
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache
