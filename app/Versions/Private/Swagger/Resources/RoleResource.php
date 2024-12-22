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
final readonly class RoleResource
{
    #[OA\Property(
        title: 'name',
        description: 'Название',
    )]
    private string $name;
}
