.PHONY: build up down composer-install test

build:
	docker-compose up --build -d

down:
	docker-compose down

test:
	docker-compose exec app vendor/bin/phpunit

database:
	docker-compose exec app php vendor/bin/doctrine orm:schema-tool:update --force