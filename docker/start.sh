#!/bin/bash
set -e

# Render assigns a dynamic port via $PORT. Default to 10000 if not set (e.g. local testing).
PORT="${PORT:-10000}"
sed -i "s/PORT_PLACEHOLDER/$PORT/g" /etc/nginx/sites-available/default

# Ensure Laravel storage link exists
php artisan storage:link || true

# Cache config/routes/views for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations (safe to run on every deploy; only applies pending migrations)
php artisan migrate --force

# Start php-fpm and nginx together
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
