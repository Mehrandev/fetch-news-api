<?php

namespace App\Providers;

use App\Factories\Contracts\RepositoryFactoryInterface;
use App\Factories\RepositoryFactory;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\SourceRepositoryInterface;
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
        $this->app->singleton(RepositoryFactory::class, function () {
            return new RepositoryFactory();
        });

        // Bind all repositories using the RepositoryFactory
        $this->app->singleton(ArticleRepositoryInterface::class, function ($app) {
            return $app->make(RepositoryFactory::class)->createArticleRepository();
        });

        $this->app->singleton(CategoryRepositoryInterface::class, function ($app) {
            return $app->make(RepositoryFactory::class)->createCategoryRepository();
        });

        $this->app->singleton(SourceRepositoryInterface::class, function ($app) {
            return $app->make(RepositoryFactory::class)->createSourceRepository();
        });

        $this->app->singleton(UserRepositoryInterface::class, function ($app) {
            return $app->make(RepositoryFactory::class)->createUserRepository();
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
