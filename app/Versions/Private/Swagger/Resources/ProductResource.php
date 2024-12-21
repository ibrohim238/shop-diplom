<?php

namespace App\Versions\Private\Swagger\Resources;

use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ProductResource',
    description: 'Product Resource',
    xml: new OA\Xml(
        name: 'Product Resource',
    ),
)]
final class ProductResource
{
    #[OA\Property(
        title: 'id',
        description: 'Идентификатор',
        format: 'int64',
        example: 1,
    )]
    private readonly int $id;

    #[OA\Property(
        title: 'name',
        description: 'Название',
    )]
    private readonly string $name;

    #[OA\Property(
        title: 'description',
        description: 'Описание',
    )]
    private readonly string $description;

    #[OA\Property(
        title: 'medias',
        description: 'medias',
        type: 'array',
        items: new OA\Items(ref: '#/components/schemas/MediaResource')
    )]
    private readonly array $medias;

    #[OA\Property(
        title: 'categories',
        description: 'categories',
        type: 'array',
        items: new OA\Items(ref: '#/components/schemas/CategoryResource')
    )]
    private readonly array $categories;

    #[OA\Property(
        title: "сreated_at",
        description: "Создана в",
        type: "string",
        format: "datetime",
        example: "2020-01-27 17:50:45",
    )]
    private readonly Carbon $created_at;


    #[OA\Property(
        title: "updated_at",
        description: "Обновлена в",
        type: "string",
        format: "datetime",
        example: "2020-01-27 17:50:45",
    )]
    private readonly Carbon $updated_at;
}
