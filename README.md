## Setup

`podman build -f Dockerfile -t rackforest --no-cache`

`podman container run --name rackforest -d -v $(pwd):/var/www/html/rackforest:z -p 8000:8000 rackforest`

`podman container exec rackforest composer install`

## Fix code style

`PHP_CS_FIXER_IGNORE_ENV=1 ./vendor/bin/php-cs-fixer fix src --rules=@PER-CS2.0`
