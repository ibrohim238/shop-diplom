<?php

namespace App\Versions\Admin\Services;

use App\Enums\CouponTypeEnum;
use App\Models\Coupon;
use App\Models\Order;
use App\Versions\Admin\Dtos\CouponDto;
use Illuminate\Validation\ValidationException;

final readonly class CouponService
{
    public function __construct(
        private Coupon $coupon
    ) {
    }

    public function store(CouponDto $dto): Coupon
    {
        $this->save($dto);

        return $this->coupon;
    }

    private function save(CouponDto $dto): void
    {
        $this->coupon
            ->fill($dto->toArray())
            ->save();
    }

    public function consider(Order $order, int $amount): int
    {
        if ($this->coupon->min_price > $amount) {
            throw ValidationException::withMessages([
                'coupon_code' => __(
                    'validation.min_price',
                    [
                        'attribute' => 'coupon_code',
                        'min_price' => $this->coupon->min_price,
                    ]
                )
            ]);
        }

        $order->coupon()->associate($this->coupon);
        $this->coupon->quantity_used ++;
        $this->coupon->save();
        return match ($this->coupon->type) {
            CouponTypeEnum::PERCENT_DISCOUNT => $amount * (100 - $this->coupon->amount) /100,
            CouponTypeEnum::FIXED_DISCOUNT => $amount - $this->coupon->amount,
        };
    }

    public static function fromCode(string $code): self
    {
        return new self(
            Coupon::query()
                ->where('code', $code)
                ->first()
        );
    }
}
