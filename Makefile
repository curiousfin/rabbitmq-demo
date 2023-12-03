init: down build up
up:
	docker-compose -p rabbitmq-demo up -d
stop:
	docker-compose -p rabbitmq-demo stop
down:
	docker-compose -p rabbitmq-demo down
build:
	docker-compose -p rabbitmq-demo build