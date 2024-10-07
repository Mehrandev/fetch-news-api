<?php

namespace App\Repositories\Contracts;

use App\Models\UserPersonalization;

interface UserPersonalizationRepositoryInterface
{
    public function findByUserId(int $userId): ?UserPersonalization;

    public function createOrUpdatePersonalization(array $data, int $userId): UserPersonalization;
}
