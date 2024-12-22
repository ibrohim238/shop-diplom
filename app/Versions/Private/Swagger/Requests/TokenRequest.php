<?php

namespace App\Versions\Private\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Purchase request',
    description: 'Purchase request body data',
    required: ['first_name', 'last_name', 'email'],
    type: 'object',
)]
final readonly class TokenRequest
{
    #[OA\Property(
        title: 'grant_type',
        description: 'Способ получения токена',
        enum: [
            'refresh_token',
            'password',
        ]
    )]
    private string $grant_type;

    #[OA\Property(
        title: 'client_id',
        description: 'Идентификатор приложения',
    )]
    private int $client_id;

    #[OA\Property(
        title: 'client_secret',
        description: 'Секретный ключ приложения',
    )]
    private string $client_secret;

    #[OA\Property(
        title: 'password',
        description: 'Пароль',
    )]
    private string $password;

    #[OA\Property(
        title: 'refresh_token',
        description: 'refresh_token',
    )]
    private string $refresh_token;
}
