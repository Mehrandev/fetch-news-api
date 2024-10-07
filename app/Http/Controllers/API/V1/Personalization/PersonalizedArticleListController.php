<?php

namespace App\Http\Controllers\API\V1\Personalization;

use App\Http\Requests\V1\Personalization\PersonalizedArticleRequest;
use App\Http\Resources\V1\Article\ArticleResource;
use App\Services\Personalization\PersonalizedArticleService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;

class PersonalizedArticleListController
{

    public function __construct(private PersonalizedArticleService $personalizedArticleService, private ResponseService $responseService)
    {
    }

    public function __invoke(PersonalizedArticleRequest $request): JsonResponse
    {
        $userId = $request->user()->id;
        $filters = $request->validated();  // Use validated filters

        // Retrieve personalized articles using the service
        $articles = $this->personalizedArticleService->getPersonalizedArticles($userId, $filters);

        $response = $this->responseService->sendResponse(ArticleResource::collection($articles), 'Personalized articles retrieved successfully');
        return response()->json($response);
    }
}
