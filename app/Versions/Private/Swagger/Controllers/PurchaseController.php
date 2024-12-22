<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Pagination;
use App\Versions\Private\Swagger\Requests\PurchaseRequest;
use App\Versions\Private\Swagger\Resources\PurchaseResource;
use OpenApi\Attributes as OA;

interface PurchaseController
{
    #[OA\Get(
        path: '/user/purchases',
        description: 'Список покупок',
        summary: 'Список покупок',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Purchases'],
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
                    items: new OA\Items(ref: PurchaseResource::class),
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
        path: '/user/purchases/{id}',
        description: 'Покупка',
        summary: 'Покупка',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Purchases'],
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
                    ref: PurchaseResource::class,
                ),
            ],
        ),
    )]
    public function show();

    #[OA\Post(
        path: '/user/purchases',
        description: 'Оплатить',
        summary: 'Оплатить',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: PurchaseRequest::class),
        ),
        tags: ['Purchases'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: PurchaseResource::class,
                ),
            ],
        ),
    )]
    public function store();
}
