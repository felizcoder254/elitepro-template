# ... your existing Dockerfile ...

# 11. Create a simple entrypoint
RUN cat > /usr/local/bin/entrypoint.sh << 'EOF'
#!/bin/bash
set -e

# Create .env if it doesn't exist
if [ ! -f .env ]; then
    echo "Creating .env file..."
    # Copy from environment variables
    env | grep -E '^(APP_|DB_|SESSION_|LOG_|BROADCAST_|CACHE_|QUEUE_)' > .env
fi

# Always use APP_KEY from Render environment (or keep existing)
if [ ! -z "$APP_KEY" ]; then
    # Remove any existing APP_KEY line
    grep -v "^APP_KEY=" .env > .env.tmp && mv .env.tmp .env
    # Add the APP_KEY from environment
    echo "APP_KEY=$APP_KEY" >> .env
fi

# Set permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Start Apache
exec apache2-foreground
EOF

RUN chmod +x /usr/local/bin/entrypoint.sh

# 12. Use the entrypoint
CMD ["/usr/local/bin/entrypoint.sh"]
