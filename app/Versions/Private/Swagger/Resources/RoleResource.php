<?php

namespace App\Versions\Private\Swagger\Resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'RoleResource',
    description: 'Role Resource',
    xml: new OA\Xml(
        name: 'Role Resource',
    ),
)]
final readonly class RoleResource
{
    #[OA\Property(
        title: 'name',
        description: 'Название',
    )]
    private string $name;
}
