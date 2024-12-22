<?php

namespace App\Versions\Private\Http\Controllers;

use App\Versions\Private\Dtos\RegisterDto;
use App\Versions\Private\Http\Requests\RegisterRequest;
use App\Versions\Private\Http\Resources\UserResource;
use App\Versions\Private\Services\UserService;

class RegisterController
{
    public function __invoke(RegisterRequest $request, UserService $service)
    {
        $user = $service
            ->register(RegisterDto::fromRequest($request));

        return UserResource::make($user);
    }
}
