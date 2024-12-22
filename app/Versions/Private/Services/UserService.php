<?php

namespace App\Versions\Private\Services;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Versions\Private\Dtos\RegisterDto;

final readonly class UserService
{
    public function __construct(
        private User $user,
    ) {
    }

    public function register(RegisterDto $dto): User
    {
        $this->user
            ->fill($dto->toArray())
            ->save();
        $this->user->assignRole(RoleEnum::USER);

        return $this->user;
    }
}
