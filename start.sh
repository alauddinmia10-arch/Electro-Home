#!/bin/bash
echo "Caching config..."
php artisan config:cache
echo "Caching routes..."
php artisan route:cache
echo "Caching views..."
php artisan view:cache

# Run database migrations
echo "Running migrations..."
php artisan migrate --force

echo "Starting Apache..."
apache2-foreground
