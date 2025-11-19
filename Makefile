DOCKER := $(shell command -v docker >/dev/null 2>&1 && echo 1 || echo 0)
COMPOSE := docker compose
ARTISAN := php artisan

.PHONY: up down restart logs bash migrate seed queue install composer-install fresh test build rebuild

up:
ifeq ($(DOCKER),1)
	$(COMPOSE) up -d
else
	@echo "Docker não está disponível neste ambiente."
	@exit 1
endif

down:
ifeq ($(DOCKER),1)
	$(COMPOSE) down
else
	@echo "Docker não está disponível neste ambiente."
	@exit 1
endif

restart:
ifeq ($(DOCKER),1)
	$(COMPOSE) down
	$(COMPOSE) up -d
else
	@echo "Docker não está disponível neste ambiente."
	@exit 1
endif

logs:
ifeq ($(DOCKER),1)
	$(COMPOSE) logs -f
else
	@echo "Docker não está disponível neste ambiente."
	@exit 1
endif

bash:
ifeq ($(DOCKER),1)
	$(COMPOSE) exec php-fpm bash
else
	@echo "Docker não está disponível neste ambiente."
	@exit 1
endif

migrate:
ifeq ($(DOCKER),1)
	$(COMPOSE) exec php-fpm $(ARTISAN) migrate
else
	@echo "Executando migrations localmente."
	@if [ ! -f vendor/autoload.php ]; then \
		echo "Dependências PHP ausentes. Execute 'composer install' antes de continuar."; \
		exit 1; \
	fi
	$(ARTISAN) migrate
endif

seed:
ifeq ($(DOCKER),1)
	$(COMPOSE) exec php-fpm $(ARTISAN) db:seed
else
	@echo "Executando seeders localmente."
	@if [ ! -f vendor/autoload.php ]; then \
		echo "Dependências PHP ausentes. Execute 'composer install' antes de continuar."; \
		exit 1; \
	fi
	$(ARTISAN) db:seed
endif

queue:
ifeq ($(DOCKER),1)
	$(COMPOSE) exec php-fpm $(ARTISAN) queue:work
else
	@echo "Executando queue:work localmente."
	@if [ ! -f vendor/autoload.php ]; then \
		echo "Dependências PHP ausentes. Execute 'composer install' antes de continuar."; \
		exit 1; \
	fi
	$(ARTISAN) queue:work
endif

install:
ifeq ($(DOCKER),1)
	$(COMPOSE) exec php-fpm composer install
else
	@echo "Executando composer install localmente."
	composer install
endif

composer-install: install

fresh:
ifeq ($(DOCKER),1)
	$(COMPOSE) exec php-fpm $(ARTISAN) migrate:fresh --seed
else
	@echo "Executando migrate:fresh --seed localmente."
	@if [ ! -f vendor/autoload.php ]; then \
		echo "Dependências PHP ausentes. Execute 'composer install' antes de continuar."; \
		exit 1; \
	fi
	$(ARTISAN) migrate:fresh --seed
endif

test:
ifeq ($(DOCKER),1)
	$(COMPOSE) exec php-fpm $(ARTISAN) test
else
	@echo "Executando testes localmente."
	@if [ ! -f vendor/autoload.php ]; then \
		echo "Dependências PHP ausentes. Execute 'composer install' antes de continuar."; \
		exit 1; \
	fi
	$(ARTISAN) test
endif

build:
ifeq ($(DOCKER),1)
	$(COMPOSE) build
else
	@echo "Docker não está disponível neste ambiente."
	@exit 1
endif

rebuild:
ifeq ($(DOCKER),1)
	$(COMPOSE) down
	$(COMPOSE) build --no-cache
	$(COMPOSE) up -d
else
	@echo "Docker não está disponível neste ambiente."
	@exit 1
endif
