<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Requests\RegisterRequest;
use App\Versions\Private\Swagger\Resources\UserResource;
use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use OpenApi\Attributes as OA;

interface RegisterController
{
    #[OA\Get(
        path: '/register',
        description: 'Регистрация',
        summary: 'Регистрация',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: RegisterRequest::class),
        ),
        tags: ['OAuth'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: UserResource::class,
                ),
            ],
        ),
    )]
    #[NotFoundResponse]
    public function register();
}
