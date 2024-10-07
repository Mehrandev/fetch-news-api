<?php

namespace App\Http\Requests\V1\Article;

use Illuminate\Foundation\Http\FormRequest;

class ListArticlesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1|max:100',
            'search' => 'string|nullable',
            'category' => 'string|nullable',
            'source' => 'string|nullable',
            'date' => 'date|nullable|date_format:Y-m-d',
        ];
    }
}
