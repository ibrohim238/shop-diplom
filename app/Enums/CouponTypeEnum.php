<?php

namespace App\Enums;

enum CouponTypeEnum: int
{
    use EnumTrait;

    // Процентная скидка
    case PERCENT_DISCOUNT = 0;
    // Фиксированная скидка
    case FIXED_DISCOUNT = 1;
    //    // Бесплатная доставка
    //    case FREE_SHIPPING = 2;
}
