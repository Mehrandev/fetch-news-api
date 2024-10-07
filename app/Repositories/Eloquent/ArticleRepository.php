<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll(array $filters = []): Collection
    {
        return Article::query()
            ->when(isset($filters['category_id']), function ($query) use ($filters) {
                $query->where('category_id', $filters['category_id']);
            })
            ->when(isset($filters['source_id']), function ($query) use ($filters) {
                $query->where('source_id', $filters['source_id']);
            })
            ->get();
    }

    public function findById(int $id)
    {
        return Article::with(['category', 'source'])->find($id);
    }

    public function create(array $data)
    {
        // Manually assign fields to prevent mass assignment
        $article = new Article();
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->category_id = $data['category_id'];
        $article->source_id = $data['source_id'];

        // Save the article and return the instance
        $article->save();
    }

    public function update(int $id, array $data)
    {
        $article = Article::find($id);
        if ($article) {
            $article->update($data);
            return $article;
        }
        return null;
    }

    public function delete(int $id)
    {
        return Article::destroy($id);
    }

    public function getFilteredArticles(array $filters = []): LengthAwarePaginator
    {
        $query = Article::with(['category', 'source']);

        // Apply search filter
        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%'); // we can use full text search here
        }

        // Filter by category
        if (!empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('name', $filters['category']);
            });
        }

        // Filter by source
        if (!empty($filters['source'])) {
            $query->whereHas('source', function ($q) use ($filters) {
                $q->where('name', $filters['source']);
            });
        }

        // Filter by specific date
        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        // Apply specific date filter
        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        // Pagination parameters
        $limit = $filters['limit'] ?? 10;
        $page = $filters['page'] ?? 1;

        return $query->paginate($limit, ['*'], 'page', $page);
    }
}
