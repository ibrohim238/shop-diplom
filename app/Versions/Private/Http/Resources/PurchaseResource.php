<?php

namespace App\Versions\Private\Http\Resources;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

/** @mixin Purchase */
final class PurchaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'status' => $this->status,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'coupon' => CouponResource::make($this->whenLoaded('coupon')),
            'created_at' => $this->formatDateTime($this->created_at),
            'updated_at' => $this->formatDateTime($this->updated_at),
        ];
    }
}
