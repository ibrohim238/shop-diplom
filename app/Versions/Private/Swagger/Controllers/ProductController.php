<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use App\Versions\Private\Swagger\Responses\UnauthorizedResponse;
use OpenApi\Attributes as OA;

interface ProductController
{
    #[OA\Get(
        path: '/products',
        description: 'Список товаров',
        summary: 'Список товаров',
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
}
