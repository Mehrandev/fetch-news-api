<?php

namespace App\Providers;

use App\Factories\Contracts\ServiceFactoryInterface;
use App\Factories\ServiceFactory;
use App\Services\Auth\AuthService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
