<?php

namespace App\Versions\Private\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Purchase request',
    description: 'Purchase request body data',
    required: ['first_name', 'last_name', 'email'],
    type: 'object',
)]
final readonly class RefreshTokenRequest
{
    #[OA\Property(
        title: 'grant_type',
        description: 'тип доступа',
    )]
    private string $first_name;

    #[OA\Property(
        title: 'last_name',
        description: 'Фамилия',
    )]
    private string $last_name;

    #[OA\Property(
        title: 'email',
        description: 'Почта',
    )]
    private string $email;

    #[OA\Property(
        title: 'password',
        description: 'Пароль',
    )]
    private string $password;

    #[OA\Property(
        title: 'password_confirmation',
        description: 'Подтверждение пароля',
    )]
    private string $password_confirmation;
}
