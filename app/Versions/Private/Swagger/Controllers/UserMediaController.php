<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Pagination;
use App\Versions\Private\Swagger\Resources\MediaResource;
use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use App\Versions\Private\Swagger\Responses\UnauthorizedResponse;
use OpenApi\Attributes as OA;

interface UserMediaController
{
    #[OA\Get(
        path: '/user/media',
        description: 'Список медиа пользователя',
        summary: 'Список медиа пользователя',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['UserMedia'],
        parameters: [
            new OA\Parameter(
                name: 'limit',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer'),
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(ref: MediaResource::class),
                ),
                new OA\Property(
                    property: 'meta',
                    ref: Pagination::class,
                ),
            ],
        ),
    )]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function index();

    #[OA\Post(
        path: '/user/media/',
        description: 'Добавить медиа',
        summary: 'Добавить медиа',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['media[]'],
                    properties: [
                        new OA\Property(
                            property: 'media[]',
                            description: 'Файлы',
                            type: 'array',
                            items: new OA\Items(
                                type: 'string',
                                format: 'binary',
                            ),
                        ),
                    ],
                    type: 'object',
                ),
            ),
        ),
        tags: ['UserMedia'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(ref: MediaResource::class),
                ),
            ],
        ),
    )]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function store();

    #[OA\Delete(
        path: '/user/media/{id}',
        description: 'Удалить медиа',
        summary: 'Удалить медиа',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['UserMedia'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
            ),
        ],
    )]
    #[OA\Response(
        response: 204,
        description: 'No content',
    )]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function destroy();
}
