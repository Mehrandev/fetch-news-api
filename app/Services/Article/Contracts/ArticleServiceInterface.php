<?php

namespace App\Services\Article\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ArticleServiceInterface
{
    public function getFilteredArticles(array $filters): LengthAwarePaginator;

    public function getArticleById(int $id): ?object;

    public function getArticleByIdOrFail(int $id): ?object;

    public function bulkCreateArticles(array $articleData): bool;

}
