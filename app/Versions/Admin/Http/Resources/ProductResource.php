<?php

namespace App\Versions\Admin\Http\Resources;

use app\Http\Resources\MediaResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
final class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'medias' => MediaResource::collection($this->whenLoaded('medias')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
