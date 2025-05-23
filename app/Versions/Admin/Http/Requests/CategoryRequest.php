<?php

namespace App\Versions\Admin\Http\Requests;

use App\Enums\MediaCollectionNameEnum;
use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'media_id'    => [
                'nullable',
                'integer',
                Rule::exists(Media::class, 'id')
                    ->where(function (Builder $query) {
                        $query
                            ->where(function (Builder $query) {
                                $query->where('model_type', 'user')
                                    ->where('collection_name', MediaCollectionNameEnum::TEMP);
                            })
                            ->orWhere(function (Builder $query) {
                                $query->where('model_type', 'category');
                            });
                    }),
            ],
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists(Category::class, 'id')
                    ->when($this->category, function (Exists $exists, Category $category) {
                        $exists->whereNot('id', $category->id);
                    })
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
