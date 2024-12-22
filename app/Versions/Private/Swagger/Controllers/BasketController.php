<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Pagination;
use App\Versions\Private\Swagger\Requests\BasketRequest;
use App\Versions\Private\Swagger\Resources\BasketResource;
use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use OpenApi\Attributes as OA;

interface BasketController
{
    #[OA\Get(
        path: '/user/baskets',
        description: 'Список товаров в корзине',
        summary: 'Список товаров в корзине',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Baskets'],
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
                    items: new OA\Items(ref: BasketResource::class),
                ),
                new OA\Property(
                    property: 'meta',
                    ref: Pagination::class,
                ),
            ],
        ),
    )]
    public function index();

    #[OA\Post(
        path: '/user/baskets',
        description: 'Закинуть в корзину',
        summary: 'Закинуть в корзину',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: BasketRequest::class),
        ),
        tags: ['Baskets'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: BasketResource::class,
                ),
            ],
        ),
    )]
    public function store();

    #[OA\Delete(
        path: '/user/baskets/{id}',
        description: 'Убрать из корзины',
        summary: 'Убрать из корзины',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Baskets'],
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
    public function destroy();
}
