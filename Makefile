docker-build:
	docker-compose build

docker-stop:
	docker-compose stop

docker-up:
	docker-compose up -d

composer-install:
	docker-compose run --rm php-cli composer install

manager-test-unit:
	docker-compose run --rm php-cli php bin/phpunit --testsuite=unit