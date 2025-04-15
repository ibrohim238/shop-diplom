<?php

namespace App\Versions\Private\Swagger\Resources;

use App\Enums\OrderStatusEnum;
use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'OrderResource',
    description: 'Order Resource',
    xml: new OA\Xml(
        name: 'Order Resource',
    ),
)]
final readonly class OrderResource
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
    private OrderStatusEnum $status;

    #[OA\Property(
        title: 'orders',
        description: 'заказы',
        type: 'array',
        items: new OA\Items(ref: OrderItemResource::class),
    )]
    private array $orders;

    #[OA\Property(
        title: 'coupon',
        description: 'купон',
    )]
    private CouponResource $coupon;

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
