install:
	composer install
update:
	composer update
lint:
	composer run-script phpcs -- --standard=PSR12 SingleScripts
.PHONY: test log