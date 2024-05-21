<?php

namespace App\Http\Requests;

use App\Models\Newpaper;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewpaperRequest extends FormRequest
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
                Rule::unique(Newpaper::class)->ignore($this->route('newspaper'))
            ],
            'content' => ['required', 'string', 'max:1000'],
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
            'title' => 'Título',
            'content' => 'Contenido',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.string' => 'El titulo tiene que ser una cadena de texto',
            'body.required' => 'A message is required',
        ];
    }
}
