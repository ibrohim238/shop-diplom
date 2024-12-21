<?php

namespace App\Versions\Private\Swagger\Resources;

use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'MediaResource',
    description: 'Media Resource',
    xml: new OA\Xml(
        name: 'Media Resource',
    ),
)]
final class MediaResource
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
        example: 'Владимир',
    )]
    private readonly string $name;

    #[OA\Property(
        title: 'collection_name',
        description: 'collection name',
        example: 'default',
    )]
    private readonly string $collection_name;

    #[OA\Property(
        title: 'disk',
        description: 'disk',
        example: 'private readonly ',
    )]
    private readonly string $disk;

    #[OA\Property(
        title: 'url',
        description: 'url',
        example: 'http://localhost',
    )]
    private readonly string $url;

    #[OA\Property(
        title: "Created at",
        description: "Создана в",
        type: "string",
        format: "datetime",
        example: "2020-01-27 17:50:45",
    )]
    private readonly Carbon $created_at;
}
