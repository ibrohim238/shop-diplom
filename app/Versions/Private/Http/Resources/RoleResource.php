<?php

namespace App\Versions\Private\Http\Resources;

use App\Http\Resources\JsonResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

/* @mixin Role */
class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
