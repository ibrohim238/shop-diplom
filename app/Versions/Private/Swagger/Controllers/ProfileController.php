<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Resources\UserResource;
use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use OpenApi\Attributes as OA;

interface ProfileController
{
    #[OA\Get(
        path: '/user',
        description: 'Профиль',
        summary: 'Профиль',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['User'],
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
