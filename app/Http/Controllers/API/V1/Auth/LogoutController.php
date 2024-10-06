<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController
{
    public function __construct(private ResponseService $responseService) {}

    public function __invoke(Request $request): JsonResponse
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        // Return a standardized response
        $response = $this->responseService->sendResponse(null, 'User logged out successfully');
        return response()->json($response);
    }
}
