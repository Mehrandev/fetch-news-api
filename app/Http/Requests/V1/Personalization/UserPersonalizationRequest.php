<?php

namespace App\Http\Requests\V1\Personalization;

use Illuminate\Foundation\Http\FormRequest;

class UserPersonalizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categories' => 'array|nullable',
            'categories.*' => 'integer|exists:categories,id',  // Ensure each category ID exists in the categories table
            'sources' => 'array|nullable',
            'sources.*' => 'integer|exists:sources,id',  // Ensure each source ID exists in the sources table
        ];
    }

    /**
     * Custom error messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'categories.*.exists' => 'One or more of the selected categories are invalid.',
            'sources.*.exists' => 'One or more of the selected sources are invalid.',
        ];
    }
}
