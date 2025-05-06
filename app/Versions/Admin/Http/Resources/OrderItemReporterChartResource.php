<?php

namespace App\Versions\Admin\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemReporterChartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'date'         => $this->truncated_date,
            'quantity'     => $this->quantity,
            'total_amount' => $this->total_amount,
        ];
    }
}
