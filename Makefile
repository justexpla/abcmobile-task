start:
	docker-compose start

stop:
	docker-compose stop

build:
	docker-compose up --build -d

cli:
	docker-compose exec php /bin/bash
