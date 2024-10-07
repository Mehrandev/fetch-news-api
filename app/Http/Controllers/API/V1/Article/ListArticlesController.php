<?php

namespace App\Http\Controllers\API\V1\Article;

use App\Http\Requests\V1\Article\ListArticlesRequest;
use App\Http\Resources\V1\Article\ArticleCollection;
use App\Services\Article\ArticleService;
use Illuminate\Http\JsonResponse;


/**
 * @OA\Info(
 *     title="Articles API",
 *     version="1.0.0",
 *     description="API Documentation for the Articles module"
 * ),
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Local Development Server"
 * ),
 * @OA\Schema(
 *     schema="Article",
 *     type="object",
 *     title="Article",
 *     description="Schema for an article",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Unique identifier for the article",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Title of the article",
 *         example="Technology Advances"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         description="Content of the article",
 *         example="This is the content of the article."
 *     ),
 *     @OA\Property(
 *         property="category",
 *         type="string",
 *         description="Category of the article",
 *         example="Technology"
 *     ),
 *     @OA\Property(
 *         property="source",
 *         type="string",
 *         description="Source of the article",
 *         example="TechCrunch"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the article was created",
 *         example="2024-10-10T14:00:00Z"
 *     )
 * )
 */
class ListArticlesController
{
    public function __construct(
        private ArticleService $articleService,
        private \App\Services\Response\ResponseService $responseService
    ) {}


    /**
     * List all articles with optional filters.
     *
     * @OA\Get(
     *     path="/api/v1/articles",
     *     summary="Get list of articles",
     *     description="Retrieve a paginated list of articles based on various filters",
     *     operationId="getArticles",
     *     tags={"Articles"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number for pagination",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Number of articles per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of articles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Article")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request parameters"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     *
     * @param ListArticlesRequest $request
     * @return JsonResponse
     */
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
