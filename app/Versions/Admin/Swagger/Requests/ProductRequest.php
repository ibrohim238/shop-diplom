<?php

namespace App\Versions\Admin\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Product request',
    description: 'Product request body data',
    required: ['name'],
    type: 'object',
)]
final class ProductRequest
{

    #[OA\Property(
        title: 'name',
        description: 'Имя',
        maxLength: 255,
    )]
    private readonly string $name;

    #[OA\Property(
        title: 'description',
        description: 'Описание',
        maxLength: 512,
    )]
    private readonly string $description;

    #[OA\Property(
        title: 'medias',
        description: 'medias',
        type: 'array',
        items: new OA\Items(type: 'integer'),
    )]
    private readonly array $medias;

    #[OA\Property(
        title: 'categories',
        description: 'categories',
        type: 'array',
        items: new OA\Items(type: 'integer'),
    )]
    private readonly array $categories;
}
