<?php

namespace App\Versions\Admin\Http\Resources;

use App\Http\Resources\MediaResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

/** @mixin Product */
final class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'categories'  => CategoryResource::collection($this->whenLoaded('categories')),
            'medias'      => MediaResource::collection($this->whenLoaded('media')),
            'created_at'  => $this->formatDateTime($this->created_at),
            'updated_at'  => $this->formatDateTime($this->updated_at),
        ];
    }
}
