#!/bin/bash

# Docker setup script for Sitepat Laravel application

echo "Setting up Docker for Sitepat Laravel application..."

# Copy environment file
if [ ! -f .env ]; then
    echo "Copying .env.docker to .env..."
    cp .env.docker .env
else
    echo ".env file already exists, skipping copy."
fi

# Build and start containers
echo "Building and starting Docker containers..."
docker-compose up -d --build

# Wait for database to be ready
echo "Waiting for database to be ready..."
sleep 30

# Run Laravel setup commands
echo "Running Laravel setup commands..."
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan db:seed --force
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

echo "Docker setup complete!"
echo "Application is running at: http://localhost:8080"
echo "MySQL is available at: localhost:3306"
echo "Redis is available at: localhost:6379"

echo ""
echo "Useful commands:"
echo "  docker-compose logs -f              # View logs"
echo "  docker-compose exec app bash       # Access app container"
echo "  docker-compose exec db mysql -u root -p  # Access database"
echo "  docker-compose down                # Stop containers"
echo "  docker-compose down -v            # Stop containers and remove volumes"
