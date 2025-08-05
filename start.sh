#!/bin/bash

composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan migrate --force || true
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
