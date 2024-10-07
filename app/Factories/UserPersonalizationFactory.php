<?php

namespace App\Factories;

use App\Repositories\Contracts\UserPersonalizationRepositoryInterface;
use App\Repositories\Eloquent\UserPersonalizationRepository;
use App\Services\Personalization\UserPersonalizationService;

class UserPersonalizationFactory
{
    public function createUserPersonalizationService(): UserPersonalizationService
    {
        $repository = new UserPersonalizationRepository();
        return new UserPersonalizationService($repository);
    }
}
