<?php

namespace App\Services\Decorators;

use App\Services\Article\Contracts\ArticleServiceInterface;
use Illuminate\Support\Facades\Cache;

class CachedArticleService implements ArticleServiceInterface
{
    private ArticleServiceInterface $articleService;

    public function __construct(ArticleServiceInterface $articleService)
    {
        $this->articleService = $articleService;
    }

    public function getFilteredArticles(array $filters): \Illuminate\Pagination\LengthAwarePaginator
    {
        $cacheKey = 'articles_list_' . md5(serialize($filters));

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($filters) {
            return $this->articleService->getFilteredArticles($filters);
        });
    }

    public function getArticleById(int $id): ?object
    {
        $cacheKey = 'article_single_' . $id;

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($id) {
            return $this->articleService->getArticleById($id);
        });
    }
}
