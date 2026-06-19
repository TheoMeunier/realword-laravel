<?php

declare(strict_types=1);

namespace App\Articles\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge($this->input('article', []));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'article.title'       => 'required|string|min:3|max:255',
            'article.description' => 'required|string|min:3|max:255',
            'article.body'        => 'required|string|min:3',
            'article.tagList'     => 'array|nullable',
            'article.tagList.*'   => 'string',
        ];
    }
}
