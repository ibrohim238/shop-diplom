<?php

namespace App\Versions\Private\Services;

use App\Models\Cart;
use App\Versions\Private\Dtos\CartDto;

final readonly class CartService
{
    public function __construct(
        private Cart $cart,
    ) {
    }

    public function store(CartDto $cartDto): Cart
    {
        $this->cart->fill($cartDto->toArray());
        $this->cart->save();

        return $this->cart;
    }

    public function delete(): void
    {
        $this->cart->delete();
    }
}
