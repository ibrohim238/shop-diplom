<?php

namespace App\Versions\Private\Dtos;

use App\Versions\Private\Http\Requests\OrderRequest;

final readonly class OrderDto
{
    public function __construct(
        private array   $carts,
        private int     $userId,
        private ?string $couponCode,
    ) {
    }

    public static function fromRequest(OrderRequest $request): OrderDto
    {
        $validated = $request->validated();

        return new self(
            carts: $validated['carts'],
            userId: $request->user()->getKey(),
            couponCode: $validated['coupon_code'] ?? null,
        );
    }

    public function getCarts(): array
    {
        return $this->carts;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }
}
