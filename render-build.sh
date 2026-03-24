#!/usr/bin/env bash
# exit on error
set -o errexit

# Install composer dependencies
composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

# Clear caches
php artisan optimize:clear

# Run database migrations
php artisan migrate --force
