# Docker Setup for Sitepat Laravel Application

This guide will help you set up the Sitepat Laravel application using Docker.

## Prerequisites

- Docker installed on your system
- Docker Compose installed

## Quick Start

1. **Clone the repository** (if you haven't already)
   ```bash
   git clone <repository-url>
   cd Sitepat
   ```

2. **Run the setup script**
   ```bash
   ./docker-setup.sh
   ```

   This script will:
   - Copy the Docker environment file
   - Build and start all containers
   - Run Laravel setup commands
   - Generate application key
   - Run database migrations and seeders

3. **Access the application**
   - Web Application: http://localhost:8080
   - MySQL Database: localhost:3306
   - Redis: localhost:6379

## Manual Setup

If you prefer to run commands manually:

1. **Copy environment file**
   ```bash
   cp .env.docker .env
   ```

2. **Build and start containers**
   ```bash
   docker-compose up -d --build
   ```

3. **Run Laravel setup**
   ```bash
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan db:seed
   ```

## Services

The Docker setup includes the following services:

- **app**: Laravel PHP application (PHP 8.2-FPM)
- **webserver**: Nginx web server (port 8080)
- **db**: MySQL 8.0 database (port 3306)
- **redis**: Redis cache server (port 6379)

## Useful Commands

### Container Management
```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# Rebuild containers
docker-compose up -d --build

# View logs
docker-compose logs -f

# View logs for specific service
docker-compose logs -f app
```

### Application Commands
```bash
# Access application container
docker-compose exec app bash

# Run Artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan tinker
docker-compose exec app php artisan cache:clear

# Run Composer commands
docker-compose exec app composer install
docker-compose exec app composer update

# Run NPM commands
docker-compose exec app npm install
docker-compose exec app npm run dev
```

### Database Management
```bash
# Access MySQL database
docker-compose exec db mysql -u sitepat_user -p sitepat_db

# Access as root
docker-compose exec db mysql -u root -p

# Import SQL file
docker-compose exec -T db mysql -u root -p sitepat_db < backup.sql
```

## Environment Variables

Key environment variables in `.env.docker`:

- `DB_HOST=db` - MySQL container hostname
- `REDIS_HOST=redis` - Redis container hostname
- `APP_URL=http://localhost:8080` - Application URL

## Troubleshooting

### Permission Issues
If you encounter permission issues:
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

### Database Connection Issues
1. Ensure the database container is running: `docker-compose ps`
2. Check database logs: `docker-compose logs db`
3. Verify environment variables in `.env`

### Clear Caches
```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan route:clear
```

## Production Considerations

For production deployment:

1. Change default passwords in `docker-compose.yml`
2. Use environment-specific `.env` files
3. Set up proper SSL/TLS certificates
4. Configure proper backup strategies for database volumes
5. Use Docker secrets for sensitive information
6. Consider using Docker Swarm or Kubernetes for orchestration

## File Structure

```
.
├── Dockerfile              # PHP application container
├── docker-compose.yml      # Multi-container configuration
├── .dockerignore          # Files to exclude from Docker context
├── .env.docker           # Docker-specific environment variables
├── docker-setup.sh       # Automated setup script
└── docker/
    └── nginx/
        └── default.conf   # Nginx configuration
```
