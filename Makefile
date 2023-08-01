DOCKER_RUN  = docker-compose run --rm laravel.test
PHPUNIT     = ./vendor/bin/phpunit
PHPSTAN     = ./vendor/bin/phpstan --memory-limit=1G
PHPINSIGHTS = ./vendor/bin/phpinsights
SAIL        = ./vendor/bin/sail
ARTISAN     = php artisan

.PHONY: start down install update test check-standards lint-fix ide-helper db-up db-reset key-gen jwt-key cache-clear copy-env init

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

start: ## start the docker services
	$(SAIL) up -d

stop: ## down docker services
	$(SAIL) stop

install: ## install all php libraries
	$(SAIL) composer install

update: ## update all php libraries
	$(SAIL) composer update

test: ## run tests
	$(SAIL) $(ARTISAN) test

standards: ## check if code complies to standards
	$(DOCKER_RUN) $(PHPSTAN)
	$(DOCKER_RUN) $(PHPINSIGHTS)

lint-fix: ## fixes phpinsights
	$(DOCKER_RUN) $(PHPINSIGHTS) --fix

ide-helper: ## generate ide-helper files
	$(SAIL) $(ARTISAN) ide-helper:generate
	$(SAIL) $(ARTISAN) ide-helper:models
	$(SAIL) $(ARTISAN) ide-helper:meta

db-up: ## run migration and seed
	$(SAIL) $(ARTISAN) migrate --seed

db-reset: ## reset and re-seed
	$(SAIL) $(ARTISAN) migrate:refresh --seed

key-gen: ## Generate Private/Public keys
	$(SAIL) $(ARTISAN) key:generate

cache-clear: ## reset and re-seed
	$(SAIL) $(ARTISAN) cache:clear

copy-env: ## Copy .env file
	cp .env.example .env

init: install key-gen db-up ## Initialize for first time setup
