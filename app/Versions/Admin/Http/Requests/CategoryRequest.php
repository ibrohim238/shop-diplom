<?php

namespace App\Versions\Admin\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'parent_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
