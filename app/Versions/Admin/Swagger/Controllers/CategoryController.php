<?php

namespace App\Versions\Admin\Swagger\Controllers;

use App\Versions\Admin\Swagger\Responses\NotFoundResponse;
use App\Versions\Admin\Swagger\Responses\UnauthorizedResponse;
use App\Versions\Admin\Swagger\Responses\UnprocessableEntityResponse;
use OpenApi\Attributes as OA;

interface CategoryController
{
    #[OA\Get(
        path: '/categories',
        description: 'Список категорий',
        summary: 'Список категорий',
        tags: ['Categories'],
        parameters: [

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
                    items: new OA\Items(ref: "#/components/schemas/CategoryResource"),
                ),
                new OA\Property(
                    property: 'meta',
                    ref: "#/components/schemas/Pagination",
                ),
            ],
        ),
    )]
    public function index();

    #[OA\Get(
        path: '/categories/{id}',
        description: 'Страница категория',
        summary: 'Страница категория',
        tags: ['Categories'],
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
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: "#/components/schemas/CategoryResource",
                ),
            ],
        ),
    )]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function show();

    #[OA\Post(
        path: '/Categories',
        description: 'Добавить категорий',
        summary: 'Добавить категорий',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CategoryRequest'),
        ),
        tags: ['Categories'],
    )]
    #[OA\Response(
        response: 201,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: "#/components/schemas/CategoryResource",
                ),
            ],
        ),
    )]
    #[UnprocessableEntityResponse]
    #[UnauthorizedResponse]
    public function store();

    #[OA\Put(
        path: '/catagories/{id}',
        description: 'Обновить категорию',
        summary: 'Обновить категорию',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CategoryRequest'),
        ),
        tags: ['Categories'],
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
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: "#/components/schemas/CategoryResource",
                ),
            ],
        ),
    )]
    #[UnprocessableEntityResponse]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function update();

    #[OA\Delete(
        '/categories/{id}',
        description: 'Удалить категорию',
        summary: 'Удалить категорию',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Categories'],
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
        description: 'OK',
        content: new OA\JsonContent(),
    )]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function destroy();
}
