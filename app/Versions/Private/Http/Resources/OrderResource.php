<?php

namespace App\Versions\Private\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

/** @mixin Order */
final class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'amount'     => $this->amount,
            'status'     => $this->status,
            'items'      => OrderItemResource::collection($this->whenLoaded('items')),
            'coupon'     => CouponResource::make($this->whenLoaded('coupon')),
            'created_at' => $this->formatDateTime($this->created_at),
            'updated_at' => $this->formatDateTime($this->updated_at),
        ];
    }
}
