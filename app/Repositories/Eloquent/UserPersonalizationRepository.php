<?php

namespace App\Repositories\Eloquent;

use App\Models\UserPersonalization;
use App\Repositories\Contracts\UserPersonalizationRepositoryInterface;

class UserPersonalizationRepository implements UserPersonalizationRepositoryInterface
{
    public function findByUserId(int $userId): ?UserPersonalization
    {
        return UserPersonalization::where('user_id', $userId)->first();
    }

    public function createOrUpdatePersonalization(array $data, int $userId): UserPersonalization
    {
        $userPersonalization = UserPersonalization::firstOrNew(['user_id' => $userId]);
        $userPersonalization->fill($data);
        $userPersonalization->save();

        return $userPersonalization;
    }
}
