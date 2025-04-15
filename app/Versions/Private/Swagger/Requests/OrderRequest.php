<?php

namespace App\Versions\Private\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Order request',
    description: 'Order request body data',
    required: ['carts'],
    type: 'object',
)]
final readonly class OrderRequest
{
    #[OA\Property(
        title: 'carts',
        description: 'Товары',
        type: 'array',
        items: new OA\Items(type: 'integer'),
    )]
    private array $carts;

    #[OA\Property(
        title: 'coupon_code',
        description: 'код купона',
        type: 'string',
    )]
    private string $coupon_code;
}
