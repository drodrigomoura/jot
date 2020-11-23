#!/bin/bash

docker stop $(docker ps -qa)

docker-compose build

echo "#####################";
echo "###### JOT ########";
echo "#####################";

cp .env.local .env

docker-compose up -d

docker exec jot_php composer install
docker exec jot_php php artisan migrate:fresh
docker exec jot_php php artisan migrate:fresh --env testing
docker exec jot_php chmod -R 775 storage
docker exec jot_php chown -R 1000:www-data storage bootstrap/cache
docker exec jot_php php artisan storage:link
docker exec jot_php php artisan key:generate

##### START SERVICES #####
docker-compose down
docker-compose up
