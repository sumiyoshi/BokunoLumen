<?php

namespace Infrastructure\Providers;

use Domain\Repositories;
use Infrastructure\Domain\Repositories as InfrastructureRepositories;
use App\Services;
use Domain\Services as DomainServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $register_list = [
        Repositories\UsersRepository::class => InfrastructureRepositories\EloquentUsersRepository::class,
    ];

    private $services_list = [
        Services\AuthService::class => DomainServices\AuthService::class,
        Services\UsersService::class => DomainServices\UsersService::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {
            return null;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') != 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        
        foreach ($this->register_list as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }

        foreach ($this->services_list as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
