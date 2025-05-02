<?php

namespace App\Versions\Admin\Swagger\Controllers;

use App\Versions\Admin\Swagger\Pagination;
use App\Versions\Admin\Swagger\Resources\OrderResource;
use App\Versions\Admin\Swagger\Responses\NotFoundResponse;
use App\Versions\Admin\Swagger\Responses\UnauthorizedResponse;
use OpenApi\Attributes as OA;

interface OrderController
{
    #[OA\Get(
        path: '/orders',
        description: 'Получение списка заказов с пагинацией',
        summary: 'Список заказов',
        tags: ['Orders'],
        parameters: [
            new OA\Parameter(
                name: 'limit',
                description: 'Количество записей на страницу',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 15,
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'Количество записей на страницу',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1,
                ),
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
        path: '/orders/{id}',
        description: 'Получение подробной информации по конкретному заказу',
        summary: 'Просмотр заказа',
        tags: ['Orders'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                description: 'Идентификатор заказа',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 1,
                ),
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
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function show();
}
