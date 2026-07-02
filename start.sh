#!/bin/bash
set -e

mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache storage/logs
chown -R www-data:www-data storage bootstrap/cache || true
chmod -R 775 storage bootstrap/cache || true

if [ ! -f .env ]; then
  cp .env.example .env
fi

php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate --force || true

exec supervisord -c /etc/supervisord.conf
