<?php

namespace App\Versions\Admin\Swagger\Controllers;

use App\Versions\Admin\Swagger\Pagination;
use App\Versions\Admin\Swagger\Requests\CategoryRequest;
use App\Versions\Admin\Swagger\Resources\CategoryResource;
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
                    items: new OA\Items(ref: CategoryResource::class),
                ),
                new OA\Property(
                    property: 'meta',
                    ref: Pagination::class,
                ),
            ],
        ),
    )]
    public function index();

    #[OA\Get(
        path: '/categories/{slug}',
        description: 'Страница категория',
        summary: 'Страница категория',
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'slug',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string'),
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
                    ref: CategoryResource::class,
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
            content: new OA\JsonContent(ref: CategoryRequest::class),
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
                    ref: CategoryResource::class,
                ),
            ],
        ),
    )]
    #[UnprocessableEntityResponse]
    #[UnauthorizedResponse]
    public function store();

    #[OA\Put(
        path: '/catagories/{slug}',
        description: 'Обновить категорию',
        summary: 'Обновить категорию',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: CategoryRequest::class),
        ),
        tags: ['Categories'],
        parameters: [
            new OA\Parameter(
                name: 'slug',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string'),
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
                    ref: CategoryResource::class,
                ),
            ],
        ),
    )]
    #[UnprocessableEntityResponse]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function update();

    #[OA\Delete(
        '/categories/{slug}',
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
                name: 'slug',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string'),
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
