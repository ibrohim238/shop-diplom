<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Pagination;
use App\Versions\Private\Swagger\Requests\OrderRequest;
use App\Versions\Private\Swagger\Resources\OrderResource;
use OpenApi\Attributes as OA;

interface OrderController
{
    #[OA\Get(
        path: '/user/orders',
        description: 'Список заказов',
        summary: 'Список заказов',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Orders'],
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
                    items: new OA\Items(ref: OrderResource::class),
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
        path: '/user/orders/{id}',
        description: 'Заказ',
        summary: 'Заказ',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Orders'],
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
                    ref: OrderResource::class,
                ),
            ],
        ),
    )]
    public function show();

    #[OA\Post(
        path: '/user/orders',
        description: 'Сделать заказ',
        summary: 'Сделать заказ',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: OrderRequest::class),
        ),
        tags: ['Orders'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: OrderResource::class,
                ),
            ],
        ),
    )]
    public function store();
}
