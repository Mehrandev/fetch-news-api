<?php

namespace App\Providers;

use App\Factories\Contracts\RepositoryFactoryInterface;
use App\Factories\RepositoryFactory;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryFactoryInterface::class, RepositoryFactory::class);

        $this->app->singleton(UserRepositoryInterface::class, function ($app) {
            $repositoryFactory = $app->make(RepositoryFactoryInterface::class);
            return $repositoryFactory->createUserRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
