#!/bin/bash

DOCKER_API = desygner-api-php
DOCKER_DB = desygner-api-db
OS := $(shell uname)

ifeq ($(OS),Darwin)
	UID = $(shell id -u)
else ifeq ($(OS),Linux)
	UID = $(shell id -u)
else
	UID = 1000
endif

run: ## Start the containers
	docker network create desygner-api-network || true
	U_ID=${UID} docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker-compose stop

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

build: ## Rebuilds all the containers
	U_ID=${UID} docker-compose build

api-logs: ## Tails the Symfony dev log
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} tail -f var/log/dev.log

ssh-api: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} bash

ssh-db: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_DB} bash

code-style: ## Runs php-cs to fix code styling following Symfony rules
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} php-cs-fixer fix src --rules=@Symfony
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} php-cs-fixer fix tests --rules=@Symfony