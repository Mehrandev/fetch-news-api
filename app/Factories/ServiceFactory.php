<?php

namespace App\Factories;

use App\Factories\Contracts\ServiceFactoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Auth\AuthService;

class ServiceFactory implements ServiceFactoryInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
}
