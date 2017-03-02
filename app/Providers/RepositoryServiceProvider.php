<?php

namespace App\Providers;

use App\Domain\Repositories;
use App\Infrastructure\Domain\Repositories as InfrastructureRepositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $repositories = [
        Repositories\UsersRepository::class => InfrastructureRepositories\EloquentUsersRepository::class,

    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}