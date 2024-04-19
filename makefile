CMD=docker exec -it cae-laravel-webserver-1

install:
	@docker compose up --build --remove-orphans -d
	@make env
	@make composer-install
	@make key-gen
	@make config-clear
	@make config-cache
	@make migrate-database
	@make chmod

create-database:
	@$(CMD) bash -c "php artisan db:create"

migrate-database:
	@$(CMD) bash -c "php artisan migrate"

unit-tests:
	@$(CMD) php artisan test

config-cache:
	@$(CMD) php artisan config:cache

config-clear:
	@$(CMD) php artisan config:clear

cache-clear:
	@$(CMD) php artisan cache:clear

key-gen:
	@$(CMD) php artisan key:generate

composer-install:
	@$(CMD) bash -c "export XDEBUG_MODE=off && composer install --no-interaction"

chmod:
	@$(CMD) bash -c "chmod -R 777 /var/www/storage"

env:
	@$(CMD) bash -c "cp .env.example .env"

down:
	@docker compose down --remove-orphans
