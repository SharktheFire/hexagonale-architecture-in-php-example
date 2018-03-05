.PHONY: help tests update bootstrap lint doc server build push deploy login docker-setup mongo-server mongo-client
.DEFAULT_GOAL := help

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-12s\033[0m %s\n", $$1, $$2}'

tests: ## Execute test suite
	./scripts/run-tests.sh

update: ## Update composer packages
	./scripts/composer update

bootstrap: ## Install composer
	./scripts/install-composer.sh && ./scripts/composer install
