<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',

            'content' => 'required|string',

            'status' => [
                'sometimes',
                Rule::in(['active', 'inactive']),
            ],

            'category_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],
        ];
    }
}