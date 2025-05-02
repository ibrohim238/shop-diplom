<?php

namespace App\Versions\Private\Services;

use App\Enums\OrderStatusEnum;
use App\Exceptions\ProductException;
use App\Models\Cart;
use App\Models\Order;
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
        $carts = Cart::query()
            ->with('product')
            ->whereIn('id', $dto->getCarts())
            ->get();

        if (
            $carts
                ->filter(function (Cart $cart) {
                    return $cart->quantity > $cart->product->quantity;
                })
                ->isNotEmpty()
        ) {
            throw ProductException::notExists();
        }

        DB::transaction(function () use ($dto, $carts) {
            $orderItems = $carts
                ->map(fn(Cart $cart) => [
                    'total_amount' => $cart->quantity * $cart->product->price,
                    'order_id'     => $this->order->id,
                    'product_id'   => $cart->product_id,
                    'quantity'     => $cart->quantity,
                ]);
            $totalAmount = $orderItems->sum('amount');
            $this->order->user()->associate($dto->getUserId());
            $couponCode = $dto->getCouponCode();
            if ($couponCode !== null) {
                $totalAmount = $this->setCoupon($couponCode, $totalAmount);
            }
            $this->order->fill([
                'status'       => OrderStatusEnum::PENDING,
                'total_amount' => $totalAmount,
            ]);
            $this->order->save();
            $this->order->items()->createMany($orderItems);
            Cart::query()
                ->whereIn('id', $dto->getCarts())
                ->delete();
        });

        return $this->order;
    }

    private function setCoupon(?string $couponCode, mixed $amount): mixed
    {
        $service = CouponService::fromCode($couponCode);
        $amount  = $service->consider($amount);
        $this->order->coupon()->associate($service->getCoupon());

        return $amount;
    }
}
