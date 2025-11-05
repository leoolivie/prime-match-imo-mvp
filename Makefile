.PHONY: up down restart logs bash migrate seed queue install composer-install fresh test

up:
	docker compose up -d

down:
	docker compose down

restart:
	docker compose down
	docker compose up -d

logs:
	docker compose logs -f

bash:
	docker compose exec php-fpm bash

migrate:
	docker compose exec php-fpm php artisan migrate

seed:
	docker compose exec php-fpm php artisan db:seed

queue:
	docker compose exec php-fpm php artisan queue:work

install:
	docker compose exec php-fpm composer install

composer-install:
	docker compose exec php-fpm composer install

fresh:
	docker compose exec php-fpm php artisan migrate:fresh --seed

test:
	docker compose exec php-fpm php artisan test

build:
	docker compose build

rebuild:
	docker compose down
	docker compose build --no-cache
	docker compose up -d
