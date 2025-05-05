<?php

namespace App\Enums;

enum OrderItemReporterTypeEnum: string
{
    use EnumTrait;

    case PRODUCT  = 'product';
    case CATEGORY = 'category';
}
