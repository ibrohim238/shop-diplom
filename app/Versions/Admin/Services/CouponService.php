<?php

namespace App\Versions\Admin\Services;

use App\Enums\CouponTypeEnum;
use App\Models\Coupon;
use App\Models\Purchase;
use App\Versions\Admin\Dtos\CouponDto;

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

    public function consider(Purchase $purchase, int $amount): int
    {
        $purchase->coupon()->associate($this->coupon);
        $this->coupon->quantity_used ++;
        $this->coupon->save();
        if ($this->coupon->type->is(CouponTypeEnum::PERCENT_DISCOUNT)) {
            $amount /= $this->coupon->amount;
        }
        if ($this->coupon->type->is(CouponTypeEnum::FIXED_DISCOUNT)) {
            $amount -= $this->coupon->amount;
        }

        return $amount;
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
