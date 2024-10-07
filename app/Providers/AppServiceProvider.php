<?php

namespace App\Providers;

use App\Factories\Contracts\ServiceFactoryInterface;
use App\Factories\ServiceFactory;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Services\Article\ArticleService;
use App\Services\Article\Contracts\ArticleServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Category\CategoryService;
use App\Services\Decorators\CachedArticleService;
use App\Services\Personalization\UserPersonalizationService;
use App\Services\Source\SourceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceFactoryInterface::class, ServiceFactory::class);

        $this->app->singleton(AuthService::class, function ($app) {
            $serviceFactory = $app->make(ServiceFactoryInterface::class);
            return $serviceFactory->createAuthService();
        });

        $this->app->singleton(ArticleService::class, function ($app) {
            $serviceFactory = $app->make(ServiceFactoryInterface::class);
            return $serviceFactory->createArticleService();
        });

        $this->app->singleton(CategoryService::class, function ($app) {
            $serviceFactory = $app->make(ServiceFactoryInterface::class);
            return $serviceFactory->createCategoryService();
        });

        $this->app->singleton(SourceService::class, function ($app) {
            $serviceFactory = $app->make(ServiceFactoryInterface::class);
            return $serviceFactory->createSourceService();
        });

        $this->app->singleton(UserPersonalizationService::class, function ($app) {
            $serviceFactory = $app->make(ServiceFactoryInterface::class);
            return $serviceFactory->createUserPersonalizationService();
        });
        // Bind the core service or use the decorated service
        $this->app->singleton(ArticleServiceInterface::class, function ($app) {
            $coreService = new ArticleService($app->make(ArticleRepositoryInterface::class));
            // Decorate the core service with caching
            return new CachedArticleService($coreService);
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
