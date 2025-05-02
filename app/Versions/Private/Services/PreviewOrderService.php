<?php

namespace App\Versions\Private\Services;

use App\Exceptions\ProductException;
use App\Models\Cart;
use App\Versions\Admin\Services\CouponService;
use App\Versions\Private\Dtos\OrderDto;

final readonly class PreviewOrderService
{
    public function preview(OrderDto $dto): array
    {
        $carts = Cart::query()
            ->with('product')
            ->whereIn('id', $dto->getCarts())
            ->get();

        $amount = $carts
            ->map(fn(Cart $cart) => $cart->quantity * $cart->product->price)
            ->sum();
        $couponCode = $dto->getCouponCode();
        $discount = 0;
        if ($couponCode !== null) {
            $discount = CouponService::fromCode($couponCode)
                ->preview($amount);
        }

        return [
            'amount'   => $amount,
            'discount' => $discount,
        ];
    }
}
