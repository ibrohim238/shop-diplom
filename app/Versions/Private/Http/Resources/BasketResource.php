<?php

namespace App\Versions\Private\Http\Resources;

use App\Http\Resources\JsonResource;
use App\Models\Basket;
use Illuminate\Http\Request;

/** @mixin Basket */
final class BasketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => ProductResource::make($this->whenLoaded('product')),
            'quantity' => $this->quantity,
            'created_at' => $this->formatDateTime($this->created_at),
            'updated_at' => $this->formatDateTime($this->updated_at),
        ];
    }
}
