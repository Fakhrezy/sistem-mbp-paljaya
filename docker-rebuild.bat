@echo off
echo 🐳 Rebuilding Docker containers for Laravel application...

REM Stop and remove existing containers
echo 📦 Stopping existing containers...
docker-compose down

REM Rebuild and start containers
echo 🔨 Building and starting containers...
docker-compose up -d --build

REM Wait for containers to be ready
echo ⏳ Waiting for containers to be ready...
timeout /t 10

REM Run Laravel setup commands
echo 🚀 Running Laravel setup commands...
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

REM Set permissions
echo 🔐 Setting proper permissions...
docker-compose exec app chmod -R 775 storage
docker-compose exec app chmod -R 775 public/storage
docker-compose exec app chown -R www-data:www-data storage
docker-compose exec app chown -R www-data:www-data public/storage

echo ✅ Docker setup complete!
echo 🌐 Application should be available at: http://127.0.0.1:8081
echo 📊 phpMyAdmin available at: http://127.0.0.1:8082
pause
