<?php

namespace App\Versions\Private\Dtos;

use App\Versions\Private\Http\Requests\CartRequest;

final readonly class CartDto
{
    public function __construct(
        private int $userId,
        private int $productId,
        private int $quantity,
    ) {
    }

    public static function fromRequest(CartRequest $request): CartDto
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
            'user_id'    => $this->userId,
            'product_id' => $this->productId,
            'quantity'   => $this->quantity,
        ];
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
