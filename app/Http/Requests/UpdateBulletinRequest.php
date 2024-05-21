<?php

namespace App\Http\Requests;

use App\Enums\BulletinStatus;
use App\Models\Bulletin;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBulletinRequest extends FormRequest
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
                'sometimes', 'required', 'string', 'max:100',
                Rule::unique(Bulletin::class)->ignore($this->route('bulletin'))
            ],
            'content' => ['sometimes', 'required', 'string', 'max:1000'],
            'category_id' => [
                'sometimes', 'required', 'integer',
                Rule::exists(Category::class, 'id')
            ],
            'status' => [
                'required', 'string',
                Rule::enum(BulletinStatus::class)
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
