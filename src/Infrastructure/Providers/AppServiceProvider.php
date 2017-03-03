<?php

namespace Infrastructure\Providers;

use Domain\Repositories;
use Infrastructure\Domain\Repositories as InfrastructureRepositories;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $register_list = [
        Repositories\UsersRepository::class => InfrastructureRepositories\EloquentUsersRepository::class,
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
        foreach ($this->register_list as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}