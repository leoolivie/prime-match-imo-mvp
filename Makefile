# Makefile for a local PHP 8.3 + Composer + Node workflow.
ARTISAN=php artisan
NPM=npm
PHP=php

.PHONY: install composer-install migrate seed fresh test queue serve dev build key help

install:
\t@echo "Installing PHP and frontend dependencies..."
\tcomposer install
\tnpm install

composer-install:
\tcomposer install

migrate:
\t$(ARTISAN) migrate

seed:
\t$(ARTISAN) db:seed

fresh:
\t$(ARTISAN) migrate:fresh --seed

test:
\t$(ARTISAN) test

queue:
\t$(ARTISAN) queue:work

serve:
\t$(PHP) artisan serve --host=127.0.0.1 --port=8000

dev:
\t$(NPM) run dev

build:
\t$(NPM) run build

key:
\t$(ARTISAN) key:generate

help:
\t@echo "make install        # composer + npm install"
\t@echo "make migrate        # run migrations"
\t@echo "make seed           # run database seeders"
\t@echo "make fresh          # migrate:fresh --seed"
\t@echo "make test           # run phpunit tests"
\t@echo "make serve          # php artisan serve (127.0.0.1:8000)"
\t@echo "make dev            # npm run dev"
\t@echo "make build          # npm run build"
