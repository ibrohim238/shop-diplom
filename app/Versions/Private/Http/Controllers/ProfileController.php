<?php

namespace App\Versions\Private\Http\Controllers;

use App\Versions\Private\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class ProfileController
{
    public function __invoke()
    {
        $user = Auth::user();

        return UserResource::make($user->load('roles'));
    }
}
