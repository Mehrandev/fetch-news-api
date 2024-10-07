<?php

namespace App\Http\Requests\V1\Personalization;

use Illuminate\Foundation\Http\FormRequest;

class PersonalizedArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'limit' => 'integer|min:1|max:100|nullable',
            'page' => 'integer|min:1|nullable',
            'search' => 'string|nullable',
            'date' => 'date|nullable|date_format:Y-m-d',
        ];
    }
}
