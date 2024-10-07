<?php

namespace App\Http\Controllers\API\V1\Personalization;

use App\Http\Requests\V1\Personalization\UserPersonalizationRequest;
use App\Services\Personalization\UserPersonalizationService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;

class CreateUserPersonalizationController
{
    public function __construct(private UserPersonalizationService $userPersonalizationService, private ResponseService $responseService)
    {
    }

    public function __invoke(UserPersonalizationRequest $request): JsonResponse
    {
        // Save user personalization preferences
        $userId = $request->user()->id;
        $userPersonalization = $this->userPersonalizationService->saveUserPersonalization($request->validated(), $userId);

        $response = $this->responseService->sendResponse($userPersonalization, 'Personalization updated successfully');
        return response()->json($response);
    }
}
