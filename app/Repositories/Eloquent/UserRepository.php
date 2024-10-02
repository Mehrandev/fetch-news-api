<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data): User
    {
        return User::create($data);
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
