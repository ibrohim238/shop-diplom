<?php

namespace App\Versions\Private\Http\Resources;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

/* @mixin Role */
class RoleResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
