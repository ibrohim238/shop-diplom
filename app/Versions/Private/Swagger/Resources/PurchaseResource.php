<?php

namespace App\Versions\Private\Swagger\Resources;

use App\Enums\PurchaseStatusEnum;
use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'PurchaseResource',
    description: 'Purchase Resource',
    xml: new OA\Xml(
        name: 'Purchase Resource',
    ),
)]
final readonly class PurchaseResource
{
    #[OA\Property(
        title: 'id',
        description: 'Идентификатор',
        format: 'int64',
        example: 1,
    )]
    private int $id;

    #[OA\Property(
        title: 'amount',
        description: 'Сумма',
    )]
    private int $amount;

    #[OA\Property(
        title: 'status',
        description: 'Статус',
    )]
    private PurchaseStatusEnum $status;

    #[OA\Property(
        title: 'product',
        description: 'товар',
        type: 'array',
        items: new OA\Items(ref: ProductResource::class)
    )]
    private array $products;

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
