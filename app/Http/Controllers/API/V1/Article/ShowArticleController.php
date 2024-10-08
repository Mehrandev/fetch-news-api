<?php

namespace App\Http\Controllers\API\V1\Article;

use App\Http\Resources\V1\Article\ArticleResource;
use App\Services\Article\ArticleService;
use Illuminate\Http\JsonResponse;

class ShowArticleController
{
    public function __construct(
        private ArticleService                         $articleService,
        private \App\Services\Response\ResponseService $responseService
    )
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        // Retrieve the article by ID
        $article = $this->articleService->getArticleByIdOrFail($id);

        // Use ArticleResource to format the response
        $response = $this->responseService->sendResponse(new ArticleResource($article), 'Article retrieved successfully');
        return response()->json($response);
    }
}
