<?php

namespace App\Services\Personalization;

use App\Models\UserPersonalization;
use App\Repositories\Contracts\UserPersonalizationRepositoryInterface;

class UserPersonalizationService
{

    public function __construct(private UserPersonalizationRepositoryInterface $userPersonalizationRepository)
    {
    }

    public function getUserPersonalization(int $userId): ?UserPersonalization
    {
        return $this->userPersonalizationRepository->findByUserId($userId);
    }

    public function saveUserPersonalization(array $data, int $userId): UserPersonalization
    {
        return $this->userPersonalizationRepository->createOrUpdatePersonalization($data, $userId);
    }
}
