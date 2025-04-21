<?php

namespace App\Versions\Private\Http\Resources;

use App\Http\Resources\JsonResource;
use App\Models\User;
use Illuminate\Http\Request;

/* @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'roles'      => RoleResource::collection($this->whenLoaded('roles')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
