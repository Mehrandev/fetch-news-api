<?php

namespace App\Http\Controllers\API\V1\Article;

use App\Http\Requests\V1\Article\ListArticlesRequest;
use App\Http\Resources\V1\Article\ArticleCollection;
use App\Services\Article\ArticleService;
use Illuminate\Http\JsonResponse;

class ListArticlesController
{
    public function __construct(
        private ArticleService $articleService,
        private \App\Services\Response\ResponseService $responseService
    ) {}

    public function __invoke(ListArticlesRequest $request): JsonResponse
    {
        // Retrieve validated query parameters
        $filters = $request->validated();

        // Get paginated articles based on filters
        $articles = $this->articleService->getFilteredArticles($filters);

        $response = $this->responseService->sendResponse(new ArticleCollection($articles), 'Articles retrieved successfully');
        return response()->json($response);
    }
}
