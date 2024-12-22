<?php

namespace App\Versions\Private\Swagger\Resources;

use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'CartResource',
    description: 'Cart Resource',
    xml: new OA\Xml(
        name: 'Cart Resource',
    ),
)]
final readonly class CartResource
{
    #[OA\Property(
        title: 'id',
        description: 'Идентификатор',
        format: 'int64',
        example: 1,
    )]
    private int $id;

    #[OA\Property(
        title: 'product',
        description: 'товар',
    )]
    private ProductResource $product;

    #[OA\Property(
        title: 'quantity',
        description: 'Количество',
    )]
    private int $quantity;

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
