<?php

namespace App\Versions\Private\Swagger\Resources;

use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ProductResource',
    description: 'Product Resource',
    xml: new OA\Xml(
        name: 'Platform Resource',
    ),
)]
final readonly class UserResource
{
    #[OA\Property(
        title: 'id',
        description: 'Идентификатор',
        format: 'int64',
        example: 1,
    )]
    private int $id;

    #[OA\Property(
        title: 'first_name',
        description: 'Имя',
    )]
    private string $first_name;

    #[OA\Property(
        title: 'last_name',
        description: 'Фамилия',
    )]
    private string $last_name;

    #[OA\Property(
        title: 'email',
        description: 'Почта',
    )]
    private string $email;

    #[OA\Property(
        title: 'roles',
        description: 'Роли',
        type: 'array',
        items: new OA\Items(ref: RoleResource::class),
    )]
    private array $roles;

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
