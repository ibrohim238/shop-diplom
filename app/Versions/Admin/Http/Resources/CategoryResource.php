<?php

namespace App\Versions\Admin\Http\Resources;

use App\Http\Resources\MediaResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

/** @mixin Category */
final class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'media' => MediaResource::make($this->getFirstMedia()),
            'created_at' => $this->formatDateTime($this->created_at),
            'updated_at' => $this->formatDateTime($this->updated_at),
        ];
    }
}
