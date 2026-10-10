#!/bin/sh
set -e

# Port substitution for Render, Railway, Koyeb
PORT="${PORT:-8080}"
echo "==> Configuring Nginx to listen on port ${PORT}..."
sed -i "s/8080/${PORT}/g" /etc/nginx/http.d/default.conf

# Generate APP_KEY if not present
if [ -z "$APP_KEY" ]; then
    echo "==> APP_KEY not provided. Generating new application key..."
    php artisan key:generate --force
fi

# Ensure storage directories exist
mkdir -p storage/framework/cache/data \
         storage/framework/sessions \
         storage/framework/views \
         storage/logs \
         bootstrap/cache \
         database

# Fix ownership and permissions
chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache

# Create storage symlink
echo "==> Creating storage link..."
php artisan storage:link --force || true

# Check database configuration
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    export DB_CONNECTION=sqlite
    export DB_DATABASE=/var/www/html/database/database.sqlite
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        echo "==> Creating SQLite database file..."
        touch /var/www/html/database/database.sqlite
    fi
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Migrations
echo "==> Running database migrations..."
php artisan migrate --force || true

# Seed if RUN_SEEDER=true or if not yet seeded
if [ "$RUN_SEEDER" = "true" ] || [ ! -f storage/.seeded ]; then
    echo "==> Running database seeder..."
    php artisan db:seed --force || true
    touch storage/.seeded || true
fi

# Optimize Laravel for production
if [ "$APP_ENV" = "production" ]; then
    echo "==> Caching configuration, routes, and views..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

echo "==> Starting Web Server via Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
