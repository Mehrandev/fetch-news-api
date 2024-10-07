<?php

namespace App\Factories\Contracts;

use App\Services\Article\ArticleService;
use App\Services\Auth\AuthService;
use App\Services\Category\CategoryService;
use App\Services\Personalization\UserPersonalizationService;
use App\Services\Source\SourceService;

interface ServiceFactoryInterface
{
    public function createAuthService(): AuthService;

    public function createArticleService(): ArticleService;

    public function createCategoryService(): CategoryService;

    public function createSourceService(): SourceService;

    public function createUserPersonalizationService(): UserPersonalizationService;
}
