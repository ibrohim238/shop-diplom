<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use OpenApi\Attributes as OA;

interface BasketController
{
    #[OA\Get(
        path: '/baskets',
        description: 'Список товаров в корзине',
        summary: 'Список товаров в корзине',
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

    #[OA\Post(
        path: '/baskets/{id}/attach',
        description: 'Закинуть в корзину',
        summary: 'Закинуть в корзину',
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
    public function attach();

    #[OA\Post(
        path: '/baskets/{id}/detach',
        description: 'Убрать из корзины',
        summary: 'Убрать из корзины',
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
    public function detach();
}
