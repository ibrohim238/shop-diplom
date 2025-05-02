<?php

namespace App\Versions\Admin\Swagger\Controllers;

use App\Versions\Admin\Swagger\Pagination;
use App\Versions\Admin\Swagger\Requests\CouponRequest;
use App\Versions\Admin\Swagger\Resources\CouponResource;
use App\Versions\Admin\Swagger\Responses\NotFoundResponse;
use App\Versions\Admin\Swagger\Responses\UnauthorizedResponse;
use App\Versions\Admin\Swagger\Responses\UnprocessableEntityResponse;
use OpenApi\Attributes as OA;

interface CouponController
{
    #[OA\Get(
        path: '/coupons',
        description: 'Список купонов',
        summary: 'Список купонов',
        tags: ['Coupons'],
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
                    items: new OA\Items(ref: CouponResource::class),
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
        path: '/coupons/{id}',
        description: 'Страница купона',
        summary: 'Страница купона',
        tags: ['Coupons'],
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
                    ref: CouponResource::class,
                ),
            ],
        ),
    )]
    #[NotFoundResponse]
    #[UnauthorizedResponse]
    public function show();

    #[OA\Post(
        path: '/coupons',
        description: 'Добавить купон',
        summary: 'Добавить купон',
        security: [
            [
                'api-key' => [],
            ],
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: CouponRequest::class),
        ),
        tags: ['Coupons'],
    )]
    #[OA\Response(
        response: 201,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    ref: CouponResource::class,
                ),
            ],
        ),
    )]
    #[UnprocessableEntityResponse]
    #[UnauthorizedResponse]
    public function store();

    #[OA\Delete(
        '/coupons/{id}',
        description: 'Удалить купон',
        summary: 'Удалить купон',
        security: [
            [
                'api-key' => [],
            ],
        ],
        tags: ['Coupons'],
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
