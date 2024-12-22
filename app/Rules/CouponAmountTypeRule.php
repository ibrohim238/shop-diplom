<?php

namespace App\Rules;

use App\Enums\CouponTypeEnum;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class CouponAmountTypeRule implements ValidationRule, DataAwareRule
{
    private CouponTypeEnum $type;

    public function setData(array $data): void
    {
        $this->type = CouponTypeEnum::tryFrom($data['type'] ?? null);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->type === null || !is_int($value)) {
            return;
        }

        if ($this->type->is(CouponTypeEnum::PERCENT_DISCOUNT) && ($value < 0 || $value > 100)) {
            $fail(__('Когда поле type = :type значение поля :attribute может быть только 1-100', ['type' => $this->type->value, 'attribute' => $attribute]));
        }

        if ($this->type->is(CouponTypeEnum::FIXED_DISCOUNT) && ($value < 0)) {
            $fail(__('Когда поле type = :type значение поля :attribute должно быть больше 0', ['type' => $this->type->value, 'attribute' => $attribute]));
        }
    }
}
