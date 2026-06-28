#!/bin/bash

echo "🚀 Testing Sitepat with OrbStack"

# Check if OrbStack is working
echo "📊 Checking Docker with OrbStack..."
docker --version
docker info | head -5

# Start timing
START_TIME=$(date +%s)
echo "⏱️  Starting containers (timing performance)..."

# Start containers
docker-compose up -d --build

# Wait for startup
sleep 25

# End timing
END_TIME=$(date +%s)
STARTUP_TIME=$((END_TIME - START_TIME))

echo "⚡ Startup completed in ${STARTUP_TIME} seconds"

# Check status
echo "📋 Container status:"
docker-compose ps

# Test website
echo "🌐 Testing website..."
if curl -f -s http://localhost:8080 >/dev/null; then
    echo "✅ SUCCESS! Website running at http://localhost:8080"
    echo "🔑 Login: admin / admin22"
    echo "⚡ OrbStack Performance: ${STARTUP_TIME}s startup time"
else
    echo "❌ Website not responding yet, checking logs..."
    docker-compose logs --tail=10 app
fi

echo "\n🎯 Expected OrbStack benefits:"
echo "   - Faster builds and startups"
echo "   - Better file system performance"
echo "   - Lower memory usage"
echo "   - Improved battery life"
