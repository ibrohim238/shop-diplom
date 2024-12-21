<?php

namespace App\Versions\Private\Swagger\Controllers;

use App\Versions\Private\Swagger\Responses\NotFoundResponse;
use App\Versions\Private\Swagger\Responses\UnauthorizedResponse;
use OpenApi\Attributes as OA;

interface CategoryController
{
    #[OA\Get(
        path: '/categories',
        description: 'Список категорий',
        summary: 'Список категорий',
        tags: ['Categories'],
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
                    items: new OA\Items(ref: "#/components/schemas/CategoryResource"),
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
        path: '/categories/{id}',
        description: 'Страница категория',
        summary: 'Страница категория',
        tags: ['Categories'],
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
                    ref: "#/components/schemas/CategoryResource",
                ),
            ],
        ),
    )]
    #[NotFoundResponse]
    public function show();
}
