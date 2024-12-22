<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Pagination;
use App\Versions\Private\Swagger\Requests\CartRequest;
use App\Versions\Private\Swagger\Resources\CartResource;
use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use OpenApi\Attributes as OA;

interface CartController
{
    #[OA\Get(
        path: '/user/carts',
        description: 'Список товаров в корзине',
        summary: 'Список товаров в корзине',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Carts'],
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
                    items: new OA\Items(ref: CartResource::class),
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
        path: '/user/carts',
        description: 'Закинуть в корзину',
        summary: 'Закинуть в корзину',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: CartRequest::class),
        ),
        tags: ['Carts'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: CartResource::class,
                ),
            ],
        ),
    )]
    public function store();

    #[OA\Delete(
        path: '/user/carts/{id}',
        description: 'Убрать из корзины',
        summary: 'Убрать из корзины',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Carts'],
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
