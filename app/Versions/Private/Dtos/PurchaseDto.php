<?php

namespace App\Versions\Private\Dtos;

use App\Versions\Private\Http\Requests\PurchaseRequest;

final readonly class PurchaseDto
{
    public function __construct(
        private array $baskets,
        private int $userId,
        private ?string $couponCode,
    ) {
    }

    public static function fromRequest(PurchaseRequest $request): PurchaseDto
    {
        $validated = $request->validated();

        return new self(
            baskets: $validated['baskets'],
            userId: $request->user()->getKey(),
            couponCode: $validated['coupon_code']
        );
    }

    public function getBaskets(): array
    {
        return $this->baskets;
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
