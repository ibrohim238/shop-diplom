<?php

namespace App\Enums;

enum OrderStatusEnum: int
{
    use EnumTrait;
    case PENDING = 0;
}
