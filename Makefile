DOCKER_COMPOSE = docker-compose
COMPOSE_FILE=docker-compose.yml
EXEC_PHP = $(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec app
EXEC_DB = $(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec db
EXEC_REDIS = $(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec redis

up:
	docker compose -f $(COMPOSE_FILE) up -d --build

down:
	docker compose -f $(COMPOSE_FILE) down

restart: down up

logs:
	$(DOCKER_COMPOSE) logs -f --tail=200

ps:
	$(DOCKER_COMPOSE) ps

composer-install:
	$(EXEC_PHP) composer install --no-dev

composer-dump-autoload:
	$(EXEC_PHP) composer dump-autoload

composer-update:
	$(EXEC_PHP) composer update

artisan:
	$(EXEC_PHP) php artisan $(cmd)

migrate:
	$(EXEC_PHP) sh -c "sleep 10 && php artisan migrate"

migrate-refresh:
	$(EXEC_PHP) php artisan migrate:fresh --seed

seed:
	$(EXEC_PHP) php artisan db:seed

tinker:
	$(EXEC_PHP) php artisan tinker

cache-clear:
	$(EXEC_PHP) php artisan cache:clear
	$(EXEC_PHP) php artisan config:clear
	$(EXEC_PHP) php artisan route:clear
	$(EXEC_PHP) php artisan view:clear
    $(EXEC_PHP) php artisan permission:cache-reset

clear:
	$(EXEC_PHP) php artisan optimize:clear

test:
	$(EXEC_PHP) ./vendor/bin/phpunit

bash:
	$(EXEC_PHP) bash

db:
	$(EXEC_DB) mysql -u$${DB_USERNAME:-laravel} -p$${DB_PASSWORD:-secret} $${DB_DATABASE:-laravel}

redis:
	$(EXEC_REDIS) redis-cli

generate-key:
	$(EXEC_PHP) php artisan key:generate

env:
	@if not exist ".env" ( \
		echo Created .env from .env.example && \
		copy .env.example .env \
	) else ( \
		echo  .env already exists \
	)

swagger:
    $(EXEC_PHP) php artisan l5-swagger:generate

storage-link:
    $(EXEC_PHP) php artisan storage:link

init: env up generate-key storage-link migrate seed cache-clear swagger
	@echo "Project builded"

sync: up composer-dump-autoload clear migrate seed swagger
