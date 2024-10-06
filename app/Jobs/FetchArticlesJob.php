<?php

namespace App\Jobs;

use App\Factories\SourceFactory;
use App\Services\Article\ArticleService;
use App\Services\Category\CategoryService;
use App\Services\Source\NewsAPISource;
use App\Services\Source\SourceService;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FetchArticlesJob
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        // No specific sources passed in the constructor, as they are retrieved from the DB.
    }

    public function handle(
        ArticleService  $articleService,
        CategoryService $categoryService,
        SourceService   $sourceService,
        SourceFactory   $sourceFactory
    ): void
    {
        // Fetch all sources from the database
        $sources = $sourceService->getAllSources();
        if (count($sources) == 0) {
            Log::warning("No source to fetch");
            return;
        }

        $categories = $categoryService->getAllCategories();
        if (count($categories) == 0) {
            Log::warning("No category to fetch");
            return;
        }

        foreach ($sources as $source) {
            // Use the factory to create the appropriate source class
            $sourceInstance = $sourceFactory->createSource($source->name);
            foreach ($categories as $category) {
                // Fetch and transform articles for each source using NewsAPI
                $articles = $sourceInstance->transform($sourceInstance->fetch($category->name)); //we can pass pages and etc for unlimited data fetch .

                foreach ($articles as $articleData) {

                    // Create the article linked to the category and source
                    $articleService->createArticle([
                        'title' => $articleData['title'],
                        'content' => $articleData['content'],
                        'category_id' => $category->id,
                        'source_id' => $source->id,  // Use source ID from the DB
                    ]);
                }
            }
        }
    }
}
