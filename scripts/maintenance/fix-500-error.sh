#!/bin/bash

echo "🔧 Fixing 500 Server Error - Redis Issue"

# Stop containers
echo "⏹️ Stopping containers..."
docker-compose down

# Remove app image to force rebuild
echo "🗑️ Removing old app image..."
docker image rm sitepat-app 2>/dev/null || true

# Rebuild with Redis support
echo "🔨 Rebuilding app container with Redis support..."
docker-compose build app

# Start services
echo "🚀 Starting services..."
docker-compose up -d db redis
sleep 15

docker-compose up -d app
sleep 10

docker-compose up -d webserver
sleep 5

# Clear all caches
echo "🧹 Clearing Laravel caches..."
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan route:clear

# Fix permissions
echo "🔐 Fixing permissions..."
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Test website
echo "🌐 Testing website..."
if curl -f -s http://localhost:8080 > /dev/null; then
    echo "✅ SUCCESS! Website is working at http://localhost:8080"
else
    echo "❌ Still having issues. Check logs with: docker-compose logs app"
fi

echo "📋 Container status:"
docker-compose ps
