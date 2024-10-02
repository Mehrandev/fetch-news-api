<?php

namespace App\Providers;

use App\Http\Resources\V1\Contracts\ErrorResponseContract;
use App\Http\Resources\V1\Contracts\SuccessResponseContract;
use App\Services\Response\ResponseService;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SuccessResponseContract::class, ResponseService::class);
        $this->app->bind(ErrorResponseContract::class, ResponseService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
