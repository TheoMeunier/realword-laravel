.PHONY: help
.DEFAULT_GOAL = help

dc = docker compose
de = $(dc) exec

## —— Docker 🐳  ———————————————————————————————————————————————————————————————
.PHONY: dev
dev:	## start container
	$(dc) up -d

.PHONY: in-dc
in-dc:	## connexion container php
	$(de) php bash

.PHONY: restart
restart:	## restart container
	$(dc) down
	$(dc) up --build -d

## —— Tools 🛠️️ ———————————————————————————————————————————————————————————————
.PHONY: lint
lint:  ## code style fix
	./vendor/bin/pint
	vendor/bin/rector

.PHONY: phpstan
phpstan:  ## phpstan
	vendor/bin/phpstan analyse

.PHONY: test
test:  ## phpstan
	./vendor/bin/pest

## —— Others 🛠️️ ———————————————————————————————————————————————————————————————
help: ## listing command
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
