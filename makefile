CMD=docker exec -it cae-laravel-webserver-1

install:
	@docker compose up --build --remove-orphans -d
	@make composer-install
	@make migrate-database

create-database:
	@$(CMD) bash -c "php artisan db:create"

migrate-database:
	@$(CMD) bash -c "php artisan migrate"

unit-tests:
	@$(CMD) php artisan test
composer-install:
	@$(CMD) bash -c "export XDEBUG_MODE=off && composer install --no-interaction"
