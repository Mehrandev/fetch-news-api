<?php

use App\Http\Controllers\API\V1\Article\ListArticlesController;
use App\Http\Controllers\API\V1\Article\ShowArticleController;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\LogoutController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Personalization\CreateUserPersonalizationController;
use App\Http\Controllers\API\V1\Personalization\PersonalizedArticleListController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', RegisterController::class);
        Route::post('/login', LoginController::class);
        Route::post('/logout', LogoutController::class)->middleware(['auth:sanctum']);
    });

    Route::prefix('articles')->group(function () {
        // List articles with pagination, filtering, and searching
        Route::middleware(['throttle:api'])->group(function () {
            Route::get('/', ListArticlesController::class)->name('articles.list');
            Route::get('/{id}', ShowArticleController::class)->where('id', '[0-9]+')->name('articles.show');
        });
    });

    Route::middleware('auth:sanctum')->prefix('personalization')->group(function () {
        Route::post('', CreateUserPersonalizationController::class)->name('personalization.store');
        Route::get('/articles', PersonalizedArticleListController::class)->name('personalization.articles.list');
    });

});

