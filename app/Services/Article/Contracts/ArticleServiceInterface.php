<?php

namespace App\Services\Article\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleServiceInterface
{
    public function getFilteredArticles(array $filters): LengthAwarePaginator;

    public function getArticleById(int $id): ?object;
}
