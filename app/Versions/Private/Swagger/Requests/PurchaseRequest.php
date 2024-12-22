<?php

namespace App\Versions\Private\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Purchase request',
    description: 'Purchase request body data',
    required: ['baskets'],
    type: 'object',
)]
final readonly class PurchaseRequest
{

    #[OA\Property(
        title: 'baskets',
        description: 'Товары',
        type: 'array',
        items: new OA\Items(type: 'integer')
    )]
    private array $baskets;
}
