#! /bin/bash

docker-compose -f docker-compose.dev.yml up -d --force-recreate
docker-compose -f docker-compose.dev.yml exec app php artisan key:generate
docker-compose -f docker-compose.dev.yml exec app php artisan migrate --seed

echo "Application running at http://localhost:8000"
echo "PhpMyAdmin http://localhost:8001"