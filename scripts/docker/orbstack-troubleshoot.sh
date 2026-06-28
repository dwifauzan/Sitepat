#!/bin/bash

echo "🔧 OrbStack Troubleshooting for Sitepat"

# Check if OrbStack is running
echo "📊 Checking OrbStack status..."
docker info 2>/dev/null && echo "✅ Docker/OrbStack is running" || echo "❌ Docker/OrbStack not running"

# Check project status
echo "🐳 Checking container status..."
docker-compose ps

# If containers aren't running, start them
if ! docker-compose ps | grep -q "Up"; then
    echo "🚀 Starting containers..."
    docker-compose up -d --build
    sleep 20
fi

# Test website
echo "🌐 Testing website..."
if curl -f -s http://localhost:8080 >/dev/null; then
    echo "✅ Website is working!"
else
    echo "❌ Website not responding"
    echo "📋 Container logs:"
    docker-compose logs --tail=5 app
fi

# Test database
echo "🗄️ Testing database..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "SELECT 'Database OK';" 2>/dev/null && echo "✅ Database working" || echo "❌ Database issues"

# Performance comparison
echo "⚡ OrbStack Performance Benefits:"
echo "   - Faster startup times"
echo "   - Better file sync"
echo "   - Lower memory usage"
echo "   - Improved battery life"

echo "\n🎯 Your Sitepat app should now be running faster with OrbStack!"
echo "📱 Access: http://localhost:8080"
echo "🔑 Login: admin / admin22"
