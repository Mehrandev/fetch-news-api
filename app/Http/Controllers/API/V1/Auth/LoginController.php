<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Requests\V1\Auth\LoginRequest;
use App\Services\Auth\AuthService;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;

class LoginController
{
    public function __construct(private AuthService $authService, private ResponseService $responseService)
    {
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $token = $this->authService->login($validated['email'], $validated['password']);

        if (!$token) {
            $response = $this->responseService->sendError('Invalid credentials', []);
            return response()->json($response, 401);
        }

        $response = $this->responseService->sendResponse(['token' => $token], 'Login successful',);
        return response()->json($response);
    }
}
