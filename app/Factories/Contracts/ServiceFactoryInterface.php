<?php

namespace App\Factories\Contracts;

use App\Services\Auth\AuthService;

interface ServiceFactoryInterface
{
    public function createAuthService(): AuthService;
}
