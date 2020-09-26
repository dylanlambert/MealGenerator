start:
	docker-compose up --build --force-recreate --remove-orphans -d
server-bash:
	docker-compose exec server bash

.PHONY: start server-bash
