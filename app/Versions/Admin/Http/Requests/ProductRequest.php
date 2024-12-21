<?php

namespace App\Versions\Admin\Http\Requests;

use App\Enums\MediaCollectionNameEnum;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'categories' => ['nullable', 'array', 'min:1'],
            'categories.*' => ['required', 'integer', 'exists:categories,id'],
            'medias' => ['nullable', 'array', 'min:1', 'max:10'],
            'medias.*' => [
                'required',
                'integer',
                Rule::exists(Media::class, 'id')
                    ->where('model_type', User::class)
                    ->where('collection_name', MediaCollectionNameEnum::TEMP)
            ],
        ];
    }
}
