<?php

namespace App\Versions\Private\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Register request',
    description: 'Register request body data',
    required: ['first_name', 'last_name', 'email'],
    type: 'object',
)]
final readonly class RegisterRequest
{
    #[OA\Property(
        title: 'first_name',
        description: 'Имя',
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
