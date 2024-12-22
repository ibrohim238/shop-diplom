<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource as BaseJsonResource;

class JsonResource extends BaseJsonResource
{
    public function formatDateTime(?Carbon $date): ?string
    {
        return $date?->format(DateTime::RFC3339);
    }

    public function formatDate(?Carbon $date): ?string
    {
        return $date?->format('Y-m-d');
    }
}
