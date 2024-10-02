<?php

namespace App\Http\Resources\V1\Contracts;

interface SuccessResponseContract
{
    public function sendResponse(mixed $data, string $message): array;
}
