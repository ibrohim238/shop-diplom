<?php

namespace App\Versions\Admin\Http\Resources;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

/** @mixin Coupon */
class CouponResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'code'            => $this->code,
            'description'     => $this->description,
            'type'            => $this->type,
            'amount'          => $this->amount,
            'quality_allowed' => $this->quality_allowed,
            'quantity_used'   => $this->quantity_used,
            'expires_date'    => $this->formatDate($this->expires_date),
            'orders'          => OrderResource::collection($this->whenLoaded('orders')),
            'created_at'      => $this->formatDateTime($this->created_at),
            'updated_at'      => $this->formatDateTime($this->updated_at),
        ];
    }
}
