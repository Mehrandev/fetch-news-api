<?php

namespace App\Services\Response;

use App\Http\Resources\V1\Contracts\ErrorResponseContract;
use App\Http\Resources\V1\Contracts\SuccessResponseContract;

class ResponseService implements SuccessResponseContract, ErrorResponseContract
{
    public function sendResponse(mixed $data, string $message = 'Request successful'): array
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
    }

    public function sendError(string $message = 'An error occurred', array $data = []): array
    {
        return [
            'success' => false,
            'message' => $message,
            'errors' => $data,
        ];
    }

}
