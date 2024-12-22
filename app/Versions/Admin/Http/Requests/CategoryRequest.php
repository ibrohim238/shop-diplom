<?php

namespace App\Versions\Admin\Http\Requests;

use App\Enums\MediaCollectionNameEnum;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'media_id' => [
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
                    })
            ],
            'parent_id' => [
                'required',
                'integer', Rule::exists(Category::class, 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
