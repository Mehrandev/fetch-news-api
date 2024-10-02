<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class AuthService
{

    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function register(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->createUser($data);
    }

    public function login(string $email, string $password): ?string
    {
        $user = $this->userRepository->getUserByEmail($email);
        if (!$user || !password_verify($password, $user->password)) {
            return null;
        }

        return $user->createToken('api_token')->plainTextToken;
    }
}
