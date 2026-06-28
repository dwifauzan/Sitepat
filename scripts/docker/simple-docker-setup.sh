#!/bin/bash

echo "🚀 Starting Docker setup for Sitepat Laravel application..."

# Stop and clean everything
echo "📦 Cleaning up existing containers..."
docker-compose down -v 2>/dev/null
docker system prune -f

# Prepare environment
echo "⚙️ Setting up environment..."
cp .env.docker .env

# Start database and redis
echo "🗄️ Starting database and Redis..."
docker-compose up -d db redis

# Wait for database
echo "⏳ Waiting for database to initialize (30 seconds)..."
sleep 30

# Start app
echo "🐘 Starting PHP application..."
docker-compose up -d app
sleep 15

# Start web server
echo "🌐 Starting Nginx web server..."
docker-compose up -d webserver
sleep 10

# Setup Laravel
echo "🔧 Setting up Laravel application..."
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --force
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 755 storage bootstrap/cache

# Check containers
echo "📋 Container status:"
docker-compose ps

# Test website
echo "🧪 Testing website..."
if curl -f -s http://localhost:8080 > /dev/null; then
    echo "✅ SUCCESS! Your website is running at http://localhost:8080"
else
    echo "❌ Website not responding. Check logs with: docker-compose logs"
fi

echo "📝 Useful commands:"
echo "  docker-compose ps          # Check container status"
echo "  docker-compose logs app    # View app logs"
echo "  docker-compose restart     # Restart all services"
echo "  docker-compose down        # Stop all services"
