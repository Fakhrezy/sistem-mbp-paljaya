#!/bin/bash

echo "🐳 Rebuilding Docker containers for Laravel application..."

# Stop and remove existing containers
echo "📦 Stopping existing containers..."
docker-compose down

# Remove existing volumes (optional - uncomment if you want fresh start)
# echo "🗑️ Removing existing volumes..."
# docker-compose down -v

# Rebuild and start containers
echo "🔨 Building and starting containers..."
docker-compose up -d --build

# Wait for containers to be ready
echo "⏳ Waiting for containers to be ready..."
sleep 10

# Run Laravel setup commands
echo "🚀 Running Laravel setup commands..."
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# Set permissions
echo "🔐 Setting proper permissions..."
docker-compose exec app chmod -R 775 storage
docker-compose exec app chmod -R 775 public/storage
docker-compose exec app chown -R www-data:www-data storage
docker-compose exec app chown -R www-data:www-data public/storage

echo "✅ Docker setup complete!"
echo "🌐 Application should be available at: http://127.0.0.1:8081"
echo "📊 phpMyAdmin available at: http://127.0.0.1:8082"
