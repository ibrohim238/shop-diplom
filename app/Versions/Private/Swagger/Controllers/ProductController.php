<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Pagination;
use App\Versions\Private\Swagger\Resources\ProductResource;
use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use OpenApi\Attributes as OA;

interface ProductController
{
    #[OA\Get(
        path: '/products',
        description: 'Список товаров',
        summary: 'Список товаров',
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
        path: '/product/{id}',
        description: 'Страница товара',
        summary: 'Страница товара',
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
    public function show();
}
