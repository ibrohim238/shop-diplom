<?php

namespace App\Rules;

use App\Enums\CouponTypeEnum;
use App\Models\Coupon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CouponCodeCheck implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $coupon = Coupon::query()
            ->where('code', $value)
            ->first();

        if (!$coupon) {
            $fail(__('validation.exists', ['attribute' => $attribute]));
        }
        if ($coupon->expires_date > now()) {
            $fail(__('validation.expired', ['attribute' => $attribute]));
        }
        if ($coupon->used === 0) {
            $fail(__('validation.used', ['attribute' => $attribute]));
        }
    }
}
