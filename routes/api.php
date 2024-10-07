<?php

use App\Http\Controllers\API\V1\Article\ListArticlesController;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', RegisterController::class);
        Route::post('/login', LoginController::class);
    });

    Route::prefix('articles')->group(function () {
        // List articles with pagination, filtering, and searching
        Route::get('/', ListArticlesController::class)->name('articles.list');
    });

});

Route::middleware(['auth:sanctum'])->prefix('v1/auth')->group(function () {
    Route::post('/logout', LogoutController::class);
});
