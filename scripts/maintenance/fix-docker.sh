#!/bin/bash

echo "🔧 Fixing Docker setup for Sitepat..."

# Stop everything
echo "⏹️  Stopping all containers..."
docker-compose down

# Remove any conflicting containers
echo "🗑️  Cleaning up..."
docker container prune -f
docker network prune -f

# Ensure environment is set
echo "⚙️  Setting up environment..."
cp .env.docker .env

# Start containers one by one with proper wait times
echo "🗄️  Starting MySQL database..."
docker-compose up -d db
echo "⏳ Waiting for database (30s)..."
sleep 30

echo "🔴 Starting Redis..."
docker-compose up -d redis
sleep 5

echo "🐘 Starting PHP application..."
docker-compose up -d app
echo "⏳ Waiting for PHP-FPM (20s)..."
sleep 20

echo "🌐 Starting Nginx web server..."
docker-compose up -d webserver
echo "⏳ Waiting for Nginx (10s)..."
sleep 10

# Setup Laravel properly
echo "🔧 Configuring Laravel..."
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan migrate --force

# Fix permissions
echo "🔐 Fixing permissions..."
docker-compose exec app chown -R www-data:www-data /var/www/html
docker-compose exec app chmod -R 755 /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/bootstrap/cache

# Check status
echo "📋 Container Status:"
docker-compose ps

echo "🌐 Port Mappings:"
docker-compose port webserver

# Test internal connections
echo "🔍 Testing internal connections..."
echo "Testing PHP-FPM:"
docker-compose exec webserver wget -q --spider http://app:9000 && echo "✅ PHP-FPM reachable" || echo "❌ PHP-FPM not reachable"

echo "Testing Nginx config:"
docker-compose exec webserver nginx -t

# Final test
echo "🧪 Testing website..."
sleep 5
if curl -f -s http://localhost:8080 > /dev/null; then
    echo "✅ SUCCESS! Website is running at http://localhost:8080"
    echo "🎉 Try opening http://localhost:8080 in your browser now!"
else
    echo "❌ Website still not responding"
    echo "📝 Debugging info:"
    echo "Nginx logs:"
    docker-compose logs --tail=10 webserver
    echo "\nApp logs:"
    docker-compose logs --tail=10 app
fi
