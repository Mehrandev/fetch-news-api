<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Filters\Article\CategoryFilter;
use App\Repositories\Filters\Article\DateFilter;
use App\Repositories\Filters\Article\SearchFilter;
use App\Repositories\Filters\Article\SourceFilter;
use App\Repositories\Filters\FilterManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleRepository implements ArticleRepositoryInterface
{

    private FilterManager $filterManager;

    public function __construct()
    {
        $this->filterManager = new FilterManager();
        $this->registerFilters();
    }

    private function registerFilters(): void
    {
        $this->filterManager->addFilter('category_id', new CategoryFilter());
        $this->filterManager->addFilter('source_id', new SourceFilter());
        $this->filterManager->addFilter('search', new SearchFilter());
        $this->filterManager->addFilter('date', new DateFilter());
    }

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

        $query = Article::query()->select('id', 'title', 'content', 'category_id', 'source_id', 'created_at');

        // Apply filters using the FilterManager
        $this->filterManager->apply($query, $filters);

        // Apply pagination parameters
        $limit = $filters['limit'] ?? 10;
        $page = $filters['page'] ?? 1;

        return $query->paginate($limit, ['id', 'title', 'content', 'created_at'], 'page', $page);

    }
}
