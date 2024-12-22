<?php

namespace App\Versions\Private\Swagger\Requests;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Basket request',
    description: 'Basket request body data',
    required: ['product_id', 'quantity'],
    type: 'object',
)]
final readonly class BasketRequest
{

    #[OA\Property(
        title: 'product_id',
        description: 'Id продукта',
        type: 'integer',
    )]
    private int $product_id;

    #[OA\Property(
        title: 'quantity',
        description: 'Количество',
        type: 'integer',
    )]
    private int $quantity;
}
