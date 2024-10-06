<?php

namespace App\Factories\Contracts;

use App\Repositories\Contracts\UserRepositoryInterface;

interface RepositoryFactoryInterface
{
    public function createUserRepository(): UserRepositoryInterface;
}
