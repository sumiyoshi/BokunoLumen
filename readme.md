# BokunoLumen

##install

```
php composer.phar install
cp .env.example .env
php artisan migrate
php artisan migrate:refresh --seed
```

## start server

```
php -S localhost:8000 -t ./public
```

## test

```
php vendor/bin/phpunit tests/
```

## IDE helper

```
php artisan ide-helper:generate
```
