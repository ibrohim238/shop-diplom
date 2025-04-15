<?php

namespace App\Versions\Private\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Versions\Admin\Services\CouponService;
use App\Versions\Private\Dtos\OrderDto;
use Illuminate\Support\Facades\DB;

final readonly class OrderService
{
    public function __construct(
        private Order $order,
    ) {
    }

    public function store(OrderDto $dto): Order
    {
        DB::transaction(function () use ($dto) {
            $carts = Cart::query()
                ->whereIn('id', $dto->getCarts())
                ->get();
            $amount = $carts
                ->map(fn(Cart $cart) => $cart->quantity * $cart->product->price)
                ->sum();
            $this->order->user()->associate($dto->getUserId());
            $couponCode = $dto->getCouponCode();
            if ($couponCode !== null) {
                $amount = CouponService::fromCode($couponCode)
                    ->consider($this->order, $amount);
            }
            $this->order->fill([
                'status' => OrderStatusEnum::PENDING,
                'amount' => $amount,
            ]);
            $this->order->save();
            OrderItem::query()
                ->insert(
                    $carts
                        ->map(fn(Cart $cart) => [
                            'order_id'   => $this->order->id,
                            'product_id' => $cart->product_id,
                            'quantity'   => $cart->quantity,
                        ])
                        ->toArray(),
                );
            Cart::query()
                ->whereIn('id', $dto->getCarts())
                ->delete();
        });

        return $this->order;
    }

    private function getCoupon(?int $id): Coupon
    {
        return Coupon::find($id);
    }
}
