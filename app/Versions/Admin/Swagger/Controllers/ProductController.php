<?php

namespace App\Versions\Admin\Swagger\Controllers;

use App\Versions\Admin\Swagger\Pagination;
use App\Versions\Admin\Swagger\Requests\ProductRequest;
use App\Versions\Admin\Swagger\Resources\ProductResource;
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
            new OA\Parameter(
                name: 'filter[category_id]',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'integer'),
            ),
            new OA\Parameter(
                name: 'filter[category_slug]',
                in: 'query',
                required: false,
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
                    type: 'array',
                    items: new OA\Items(ref: ProductResource::class),
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
        path: '/products/{id}',
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
                    ref: ProductResource::class,
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
            content: new OA\JsonContent(ref: ProductRequest::class),
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
                    ref: ProductResource::class,
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
            content: new OA\JsonContent(ref: ProductRequest::class),
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
                    ref: ProductResource::class,
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
