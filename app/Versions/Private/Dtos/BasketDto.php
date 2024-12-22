<?php

namespace App\Versions\Private\Dtos;

use App\Versions\Private\Http\Requests\BasketRequest;

final readonly class BasketDto
{
    public function __construct(
        private int $userId,
        private int $productId,
        private int $quantity,
    ) {
    }

    public static function fromRequest(BasketRequest $request): BasketDto
    {
        $validated = $request->validated();

        return new self(
            userId: $request->user()->getKey(),
            productId: $validated['product_id'],
            quantity: $validated['quantity'],
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
        ];
    }
}
