<?php

namespace App\Factories;

use App\Factories\Contracts\ServiceFactoryInterface;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\SourceRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Article\ArticleService;
use App\Services\Auth\AuthService;
use App\Services\Category\CategoryService;
use App\Services\Source\SourceService;

class ServiceFactory implements ServiceFactoryInterface
{

    public function __construct(private UserRepositoryInterface     $userRepository,
                                private ArticleRepositoryInterface  $articleRepository,
                                private CategoryRepositoryInterface $categoryRepository,
                                private SourceRepositoryInterface   $sourceRepository)
    {
    }

    /**
     * Create an AuthService instance.
     *
     * @return AuthService
     */
    public function createAuthService(): AuthService
    {
        return new AuthService($this->userRepository);
    }

    public function createArticleService(): ArticleService
    {
        return new ArticleService($this->articleRepository);
    }

    public function createCategoryService(): CategoryService
    {
        return new CategoryService($this->categoryRepository);
    }

    public function createSourceService(): SourceService
    {
        return new SourceService($this->sourceRepository);
    }
}
