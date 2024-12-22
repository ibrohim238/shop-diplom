<?php

namespace App\Versions\Admin\Swagger\Requests;

use App\Enums\CouponTypeEnum;
use Carbon\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Coupon request',
    description: 'Coupon request body data',
    required: ['code', 'description', 'type', 'amount'],
    type: 'object',
)]
final readonly class CouponRequest
{
    #[OA\Property(
        title: 'code',
        description: 'Код',
        maxLength: 255,
    )]
    private string $code;

    #[OA\Property(
        title: 'description',
        description: 'Описание',
        maxLength: 512,
    )]
    private string $description;

    #[OA\Property(
        title: 'type',
        description: 'Тип скидки',
        type: 'integer',
    )]
    private CouponTypeEnum $type;

    #[OA\Property(
        title: 'amount',
        description: 'Сумма',
        type: 'integer',
    )]
    private int $amount;

    #[OA\Property(
        title: 'min_price',
        description: 'Минимальная цена',
        type: 'integer',
    )]
    private int $min_price;

    #[OA\Property(
        title: 'quantity_allowed',
        description: 'Количество разрешенных',
        type: 'integer',
    )]
    private ?string $quantity_allowed;


    #[OA\Property(
        title: "expires_date",
        description: "Дата истечения",
        type: "string",
        format: "date",
        example: "2020-01-27",
    )]
    private ?Carbon $expires_date;

}
