<?php

namespace App\Versions\Admin\Swagger\Resources;

use App\Enums\CouponTypeEnum;
use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'CouponResource',
    description: 'Coupon Resource',
    xml: new OA\Xml(
        name: 'Coupon Resource',
    ),
)]
final readonly class CouponResource
{
    #[OA\Property(
        title: 'id',
        description: 'Идентификатор',
        format: 'int64',
        example: 1,
    )]
    private int $id;

    #[OA\Property(
        title: 'code',
        description: 'Код',
    )]
    private string $code;

    #[OA\Property(
        title: 'description',
        description: 'Описание',
    )]
    private string $description;

    #[OA\Property(
        title: 'type',
        description: 'Тип скидки',
    )]
    private CouponTypeEnum $type;

    #[OA\Property(
        title: 'amount',
        description: 'Сумма',
        type: 'integer',
    )]
    private int $amount;

    #[OA\Property(
        title: 'quantity_allowed',
        description: 'Количество разрешенных',
        type: 'integer',
    )]
    private string $quantity_allowed;

    #[OA\Property(
        title: 'quantity_used',
        description: 'Количество использований',
        type: 'integer',
    )]
    private string $quantity_used;

    #[OA\Property(
        title: "expires_date",
        description: "Дата истечения",
        type: "string",
        format: "date",
        example: "2020-01-27",
    )]
    private Carbon $expires_date;

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
