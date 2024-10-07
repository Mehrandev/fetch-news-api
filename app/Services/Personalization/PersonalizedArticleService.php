<?php

namespace App\Services\Personalization;

use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Contracts\UserPersonalizationRepositoryInterface;
use App\Services\Article\Contracts\ArticleServiceInterface;

class PersonalizedArticleService
{

    public function __construct(
        private UserPersonalizationRepositoryInterface $userPersonalizationRepository,
        private ArticleServiceInterface                $articleService
    )
    {
    }

    /**
     * Get articles based on user preferences and filters.
     *
     * @param int $userId
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPersonalizedArticles(int $userId, array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        // Retrieve the user’s personalization preferences
        $preferences = $this->userPersonalizationRepository->findByUserId($userId);

        if ($preferences) {
            // Add category and source preferences to the filters
            if (!empty($preferences->categories)) {
                $filters['category_id'] = $preferences->categories;
            }

            if (!empty($preferences->sources)) {
                $filters['source_id'] = $preferences->sources;
            }
        }

        return $this->articleService->getFilteredArticles($filters);
    }
}
