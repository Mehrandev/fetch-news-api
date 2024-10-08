<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ArticleDataInvalidException;
use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Filters\Article\CategoryFilter;
use App\Repositories\Filters\Article\DateFilter;
use App\Repositories\Filters\Article\SearchFilter;
use App\Repositories\Filters\Article\SourceFilter;
use App\Repositories\Filters\FilterManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function findOrFailById(int $id)
    {
        return Article::with(['category', 'source'])->findOrFail($id);
    }


    /**
     * @param array $articles
     * @return true
     * @throws ArticleDataInvalidException
     */
    public function insertMany(array $articles): bool
    {
        try {
            // Use the DB facade to perform a bulk insert
            DB::table('articles')->insertOrIgnore($articles);
            return true;
        } catch (QueryException $e) {
            // Catch and throw a custom exception if there is a database error
            throw new ArticleDataInvalidException('Failed to insert articles due to invalid data: ' . $e->getMessage());
        }
    }
}
