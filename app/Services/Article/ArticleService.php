<?php

namespace App\Services\Article;

use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Services\Article\Contracts\ArticleServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ArticleService implements ArticleServiceInterface
{

    public function __construct(private ArticleRepositoryInterface $articleRepository)
    {
    }

    public function getAllArticles(array $filters = [])
    {
        return $this->articleRepository->getAll($filters);
    }

    public function getArticleById(int $id): ?Article
    {
        return $this->articleRepository->findById($id);
    }

    public function getArticleByIdOrFail(int $id): ?Article
    {
        return $this->articleRepository->findOrFailById($id);
    }

    public function createArticle(array $data)
    {

        // Validate the incoming data
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'source_id' => 'required|integer|exists:sources,id',
        ]);

        if ($validator->fails()) {
            Log::error('Article validation failed', ['errors' => $validator->errors()]);
            return null;
        }
        return $this->articleRepository->create($this->sanitizeData($data));
    }

    public function updateArticle(int $id, array $data)
    {
        return $this->articleRepository->update($id, $data);
    }

    public function deleteArticle(int $id)
    {
        return $this->articleRepository->delete($id);
    }

    public function getFilteredArticles(array $filters = []): LengthAwarePaginator
    {
        return $this->articleRepository->getFilteredArticles($filters);
    }

    /**
     * Bulk create articles.
     *
     * @param array $articleData
     * @return bool
     * @throws \Exception
     */
    public function bulkCreateArticles(array $articleData): bool
    {
        return $this->articleRepository->insertMany($articleData);
    }

    /**
     * Sanitize data to prevent XSS attacks.
     */
    private function sanitizeData(array $data): array
    {
        return array_map(function ($value) {
            return is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
        }, $data);
    }


}
