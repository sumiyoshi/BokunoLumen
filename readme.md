# BokunoLumen

##install

```
php composer.phar install
cp .env.example .env
php artisan migrate
php artisan migrate:refresh --seed

cd resources/assets
npm install
npm run lib
npm run b
```

## start server

```
php -S localhost:8000 -t ./public
```

## test

```
php vendor/bin/phpunit tests/
```

## npm

```
cd resources/assets
npm start
```


## IDE helper

```
php artisan ide-helper:generate
```
