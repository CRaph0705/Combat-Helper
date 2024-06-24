
PHONY: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

install: ## Install the project
	symfony composer install
	symfony console doctrine:database:create
	make rebuild
	npm install

rebuild: ## Rebuild the project
## rm -rf var/cache/*
	symfony console doctrine:database:drop -f
	symfony console doctrine:database:create
	symfony console doctrine:schema:update -f
	symfony console doctrine:fixtures:load -n

start : ## Start the project
	symfony serve

stop : ## Stop the project
	symfony server:stop

test : ## Run the tests
	symfony php bin/phpunit

open : ## Open the project in the browser
	symfony open:local

build : ## Build the project
	npm run build

watch : ## Watch the project
	npm run watch
