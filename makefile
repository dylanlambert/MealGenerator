EXEC_COMPOSE = docker-compose exec -T
EXEC_SERVER = $(EXEC_COMPOSE) server
EXEC_COMPOSE_IT = docker-compose exec
EXEC_SERVER_IT = $(EXEC_COMPOSE_IT) server

start:
	docker-compose up --build --force-recreate --remove-orphans -d
server-bash:
	docker-compose exec server bash
.PHONY: start server-bash

composer-install: .composer/auth.json
	$(EXEC_SERVER) composer install
.PHONY: composer-install

composer-check-install: composer-install
.PHONY: composer-check-install

ide-helpers:
	$(EXEC_SERVER) php artisan ide-helper:eloquent
	$(EXEC_SERVER) php artisan ide-helper:generate
	$(EXEC_SERVER) php artisan ide-helper:meta
	$(EXEC_SERVER) php artisan ide-helper:models -W
.PHONY: ide-helpers

create-unit-test:
	$(EXEC_SERVER_IT) vendor/bin/phpspec desc
.PHONY: phpspec

test: composer-check-install
	$(EXEC_SERVER_IT) vendor/bin/phpspec run -v
.PHONY: phpspec