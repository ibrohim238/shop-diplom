<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Requests\TokenRequest;
use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use App\Versions\Private\Swagger\Responses\UnauthorizedResponse;
use OpenApi\Attributes as OA;

interface TokenController
{
    #[OA\Get(
        path: '/oauth/token',
        description: 'Получить токен',
        summary: 'Получить токен',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: TokenRequest::class),
        ),
        tags: ['OAuth'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(),
    )]
    #[NotFoundResponse]
    public function token();

    #[OA\Delete(
        path: '/oauth/logout',
        description: 'Отозвать access-токен пользователя',
        summary: 'Отозвать access-токен пользователя',
        tags: ['OAuth'],
    )]
    #[OA\Response(
        response: 204,
        description: 'No Content',
    )]
    #[UnauthorizedResponse]
    public function revoke(int $token_id);
}
