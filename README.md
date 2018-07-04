## install

```
docker-compose build
docker-compose exec php composer install
docker-compose exec php cp .env.example .env
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
docker-compose exec php php artisan migrate:refresh --seed
docker-compose run node npm install
```

## test

```
docker-compose exec php php  vendor/bin/phpunit tests/
```


### laravel new project

```
docker-compose exec php laravel new sample
```
