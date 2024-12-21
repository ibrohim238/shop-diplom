<?php

namespace App\Versions\Admin\Swagger\Controllers;

use App\Versions\Admin\Swagger\Responses\NotFoundResponse;
use App\Versions\Admin\Swagger\Responses\UnauthorizedResponse;
use App\Versions\Admin\Swagger\Responses\UnprocessableEntityResponse;
use OpenApi\Attributes as OA;

interface ProductController
{
    #[OA\Get(
        path: '/products',
        description: 'Список товаров',
        summary: 'Список товаров',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Products'],
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
                    items: new OA\Items(ref: "#/components/schemas/ProductResource"),
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
        path: '/product/{id}',
        description: 'Страница товара',
        summary: 'Страница товара',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Products'],
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
                    ref: "#/components/schemas/ProductResource",
                ),
            ],
        ),
    )]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function show();

    #[OA\Post(
        path: '/products',
        description: 'Добавить товар',
        summary: 'Добавить товар',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/ProductRequest'),
        ),
        tags: ['Products'],
    )]
    #[OA\Response(
        response: 201,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: "#/components/schemas/ProductResource",
                ),
            ],
        ),
    )]
    #[UnprocessableEntityResponse]
    #[UnauthorizedResponse]
    public function store();

    #[OA\Put(
        path: '/products/{id}',
        description: 'Обновить товар',
        summary: 'Обновить товар',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/ProductRequest'),
        ),
        tags: ['Products'],
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
                    ref: "#/components/schemas/ProductResource",
                ),
            ],
        ),
    )]
    #[UnprocessableEntityResponse]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function update();

    #[OA\Delete(
        '/products/{id}',
        description: 'Удалить товар',
        summary: 'Удалить товар',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Products'],
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
