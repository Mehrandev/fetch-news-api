<?php

namespace App\Factories;

use App\Factories\Contracts\RepositoryFactoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
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
}
