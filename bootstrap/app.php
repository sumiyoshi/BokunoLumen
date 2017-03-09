<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/app_helpers.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__ . '/../')
);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Infrastructure\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register ServiceProvider
|--------------------------------------------------------------------------
*/

$app->register(Infrastructure\Providers\AppServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/

$app->extend("session", function ($obj) use ($app) {
    $app->configure("session");
    return $obj;
});
$app->alias("session", \Illuminate\Session\SessionManager::class);
$app->register(\Illuminate\Session\SessionServiceProvider::class);
$app->middleware([
    Illuminate\Session\Middleware\StartSession::class,
]);

$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    'access' => App\Http\Middleware\Access::class
]);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
*/

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__ . '/../src/App/web.php';
});

/*
 |--------------------------------------------------------------------------
 | Define a callback to be used to configure Monolog.
 |--------------------------------------------------------------------------
 */
$app->configureMonologUsing(function (Monolog\Logger $monoLog) {

    $handlers[] = (
    new \Monolog\Handler\RotatingFileHandler(storage_path("logs/lumen.log"), 30)
    )->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true, true));

    $monoLog->setHandlers($handlers);

    return $monoLog;
});

return $app;
