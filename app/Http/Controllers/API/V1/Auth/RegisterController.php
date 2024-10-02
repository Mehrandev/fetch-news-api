<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\Auth\UserResource;
use App\Services\Auth\AuthService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;

class RegisterController
{


    public function __construct(private AuthService $authService, private ResponseService $responseService)
    {
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        $response = $this->responseService->sendResponse(new UserResource($user), 'User registered successfully', 201);
        return response()->json($response, 201);
    }
}
