<?php

namespace App\Versions\Admin\Swagger\Resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'OrderResource',
    description: 'Ресурс заказа',
    xml: new OA\Xml(name: 'OrderResource')
)]
final class OrderResource
{
    #[OA\Property(
        title: 'id',
        description: 'Идентификатор заказа',
        format: 'int64',
        example: 1
    )]
    private int $id;

    #[OA\Property(
        title: 'total_amount',
        description: 'Итоговая сумма заказа',
        type: 'number',
        format: 'float',
        example: 123.45
    )]
    private float $total_amount;

    #[OA\Property(
        title: 'status',
        description: 'Статус заказа',
        type: 'string',
        example: 'pending'
    )]
    private string $status;

    #[OA\Property(
        title: 'products',
        description: 'Список товаров в заказе',
        type: 'array',
        items: new OA\Items(ref: '#/components/schemas/ProductResource')
    )]
    private array $products;

    #[OA\Property(
        title: 'coupon',
        description: 'Применённый купон (если есть)',
        nullable: true,
        ref: '#/components/schemas/CouponResource'
    )]
    private ?object $coupon;

    #[OA\Property(
        title: 'created_at',
        description: 'Дата и время создания заказа',
        type: 'string',
        format: 'date-time',
        example: '2023-10-01T12:34:56Z'
    )]
    private string $created_at;

    #[OA\Property(
        title: 'updated_at',
        description: 'Дата и время последнего обновления заказа',
        type: 'string',
        format: 'date-time',
        example: '2023-10-02T09:15:30Z'
    )]
    private string $updated_at;
}