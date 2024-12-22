<?php

namespace App\Versions\Admin\Http\Requests;

use App\Enums\MediaCollectionNameEnum;
use Illuminate\Database\Query\Builder;
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
            'price' => ['required', 'numeric'],
            'categories' => ['nullable', 'array', 'min:1'],
            'categories.*' => ['required', 'integer', 'exists:categories,id'],
            'medias' => ['required', 'array', 'min:1', 'max:10'],
            'medias.*' => [
                'required',
                'integer',
                Rule::exists(Media::class, 'id')
                    ->where(function (Builder $query) {
                        $query
                            ->where(function (Builder $query) {
                                $query->where('model_type', 'user')
                                    ->where('collection_name', MediaCollectionNameEnum::TEMP);
                            })
                            ->orWhere(function (Builder $query) {
                                $query->where('model_type', 'product');
                            });
                    })
            ],
        ];
    }
}
