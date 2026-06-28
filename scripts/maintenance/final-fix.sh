#!/bin/bash

echo "🔧 Final Fix for 500 Error - Using File Sessions Instead of Redis"

# Stop everything
echo "⏹️ Stopping all containers..."
docker-compose down

# Remove Redis from environment (use file-based sessions/cache)
echo "📝 Updating environment to use file-based storage..."
cat > .env << 'EOF'
APP_NAME="Sitepat"
APP_ENV=local
APP_KEY=base64:xjixf2lWxZ2J9C0SsQFiV1SoNC6my0GAKRmwepfnHQQ=
APP_DEBUG=true
APP_URL=http://localhost:8080

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sitepat_db
DB_USERNAME=sitepat_user
DB_PASSWORD=db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
EOF

# Create simplified Dockerfile without Redis
echo "🐳 Creating simplified Dockerfile..."
cat > Dockerfile << 'EOF'
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install dependencies
RUN composer install --no-dev --no-scripts --ignore-platform-reqs

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 755 /var/www/html/bootstrap/cache

# Expose port 9000
EXPOSE 9000

CMD ["php-fpm"]
EOF

# Start database only
echo "🗄️ Starting database..."
docker-compose up -d db
sleep 20

# Build and start app
echo "🚀 Building and starting app..."
docker-compose build app
docker-compose up -d app
sleep 15

# Start webserver
echo "🌐 Starting webserver..."
docker-compose up -d webserver
sleep 10

# Setup Laravel
echo "⚙️ Setting up Laravel..."
docker-compose exec app php artisan key:generate --force
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan migrate --force

# Fix permissions one more time
echo "🔐 Final permission fix..."
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Test
echo "🧪 Testing website..."
sleep 5
if curl -f -s http://localhost:8080 >/dev/null 2>&1; then
    echo "✅ SUCCESS! Website is working at http://localhost:8080"
else
    echo "❌ Still having issues. Let's check what's happening..."
    echo "Container status:"
    docker-compose ps
    echo "\nApp logs:"
    docker-compose logs app | tail -10
    echo "\nNginx logs:"
    docker-compose logs webserver | tail -10
fi
