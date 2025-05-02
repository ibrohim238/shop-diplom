<?php

namespace App\Versions\Private\Http\Resources;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

/** @mixin OrderItem */
final class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product'  => ProductResource::make($this->whenLoaded('product')),
            'quantity' => $this->quantity,
            'total_amount' => $this->total_amount,
        ];
    }
}
