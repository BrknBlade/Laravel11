<?php

namespace App\Http\Requests;

use App\Models\Bulletin;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBulletinRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required', 'string', 'max:100',
                Rule::unique(Bulletin::class)
            ],
            'content' => ['required', 'string', 'max:1000'],
            'category_id' => [
                'required', 'integer',
                Rule::exists(Category::class, 'id')
            ]
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'category_id' => 'category',
        ];
    }
}
