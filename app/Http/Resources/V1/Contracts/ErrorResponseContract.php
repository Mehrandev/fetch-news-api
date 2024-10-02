<?php

namespace App\Http\Resources\V1\Contracts;

interface ErrorResponseContract
{
    public function sendError(string $message, array $data): array;
}
