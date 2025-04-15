<?php

namespace App\Versions\Private\Swagger\Resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'OrderResource',
    description: 'Order Resource',
    xml: new OA\Xml(
        name: 'Order Resource',
    ),
)]
final readonly class OrderItemResource
{
    #[OA\Property(
        title: 'product',
        description: 'товар',
    )]
    private ProductResource $products;

    #[OA\Property(
        title: 'quantity',
        description: 'количество',
    )]
    private int $quantity;
}
