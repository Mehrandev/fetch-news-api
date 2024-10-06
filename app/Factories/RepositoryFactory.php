<?php

namespace App\Factories;

use App\Factories\Contracts\RepositoryFactoryInterface;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\SourceRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\ArticleRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\SourceRepository;
use App\Repositories\Eloquent\UserRepository;

class RepositoryFactory implements RepositoryFactoryInterface
{
    /**
     * Create a User Repository.
     *
     * @return UserRepositoryInterface
     */
    public function createUserRepository(): UserRepositoryInterface
    {
        // Currently returns only the Eloquent implementation.
        return app(UserRepository::class);
    }

    public function createArticleRepository(): ArticleRepositoryInterface
    {
        return new ArticleRepository();
    }

    public function createCategoryRepository(): CategoryRepositoryInterface
    {
        return new CategoryRepository();
    }

    public function createSourceRepository(): SourceRepositoryInterface
    {
        return new SourceRepository();
    }
}
