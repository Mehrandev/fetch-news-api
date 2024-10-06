<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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
        return Article::find($id);
    }

    public function create(array $data)
    {
        return Article::create($data);
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
}
