#!/bin/bash

# Hentikan script saat terjadi error
set -e

# Install dependencies (tanpa dev)
composer install --no-dev --optimize-autoloader

# Set permission untuk Laravel
chmod -R 775 storage bootstrap/cache

# Generate APP_KEY jika belum ada
if [ ! -f .env ]; then
  cp .env.example .env
fi

if ! grep -q "APP_KEY=base64" .env; then
  php artisan key:generate
fi

# Cache config & routes
php artisan config:cache
php artisan route:cache

# Jalankan migrasi (abaikan error jika database belum siap)
php artisan migrate --force || true

# Jalankan server Laravel
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
