<?php

namespace App\Versions\Admin\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Product request',
    description: 'Product request body data',
    required: ['name', 'parent_id'],
    type: 'object',
)]
final class CategoryRequest
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
        title: 'parent_id',
        description: 'идентификатор родителя',
        format: 'int64',
    )]
    private readonly string $parent_id;

    #[OA\Property(
        title: 'media_id',
        description: 'media_id',
        type: 'integer',
    )]
    private readonly array $media_id;
}
