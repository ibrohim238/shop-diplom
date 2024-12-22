<?php

namespace App\Versions\Private\Swagger\Resources;

use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'CategoryResource',
    description: 'Category Resource',
    xml: new OA\Xml(
        name: 'Category Resource',
    ),
)]
final readonly class CategoryResource
{
    #[OA\Property(
        title: 'id',
        description: 'Идентификатор',
        format: 'int64',
        example: 1,
    )]
    private int $id;

    #[OA\Property(
        title: 'name',
        description: 'Название',
    )]
    private string $name;

    #[OA\Property(
        title: 'slug',
        description: 'slug',
    )]
    private string $slug;

    #[OA\Property(
        title: 'media',
        description: 'media',
    )]
    private MediaResource $media;

    #[OA\Property(
        title: 'description',
        description: 'Описание',
    )]
    private string $description;

    #[OA\Property(
        title: "сreated_at",
        description: "Создана в",
        type: "string",
        format: "datetime",
        example: "2020-01-27 17:50:45",
    )]
    private Carbon $created_at;

    #[OA\Property(
        title: "updated_at",
        description: "Обновлена в",
        type: "string",
        format: "datetime",
        example: "2020-01-27 17:50:45",
    )]
    private Carbon $updated_at;
}
