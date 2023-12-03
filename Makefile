up:
	docker-compose -p rabbitmq-demo up -d
stop:
	docker-compose -p rabbitmq-demo stop
down:
	docker-compose -p rabbitmq-demo down
build:
	docker-compose -p rabbitmq-demo build
init: down build up
composer-init:
	docker-compose run --rm app composer init
composer-require:
	docker-compose run --rm app composer require ${package}
php-modules:
	docker-compose run --rm app php -m
php-ini:
	docker-compose run --rm app cat /usr/local/etc/php/conf.d/docker-php-ext-amqp.ini