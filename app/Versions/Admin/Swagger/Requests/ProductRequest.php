<?php

namespace App\Versions\Admin\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Product request',
    description: 'Product request body data',
    required: ['name', 'price', 'medias'],
    type: 'object',
)]
final readonly class ProductRequest
{
    #[OA\Property(
        title: 'name',
        description: 'Имя',
        maxLength: 255,
    )]
    private string $name;

    #[OA\Property(
        title: 'description',
        description: 'Описание',
        maxLength: 512,
    )]
    private string $description;

    #[OA\Property(
        title: 'price',
        description: 'Цена',
        type: 'float',
    )]
    private string $price;

    #[OA\Property(
        title: 'medias',
        description: 'medias',
        type: 'array',
        items: new OA\Items(type: 'integer'),
    )]
    private array $medias;

    #[OA\Property(
        title: 'categories',
        description: 'categories',
        type: 'array',
        items: new OA\Items(type: 'integer'),
    )]
    private array $categories;
}
