CMD=docker exec -it cae-laravel-webserver-1

service-install:
	@docker compose up --build --remove-orphans -d
	@make composer-install
	@make create-database
	@make migrate-database

create-database:
	@$(CMD) bash -c "php artisan db:create"

migrate-database:
	@$(CMD) bash -c "php artisan migrate"

unit-tests:
	@$(CMD) php artisan test
