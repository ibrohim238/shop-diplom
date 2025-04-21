<?php

namespace App\Versions\Private\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Versions\Private\Dtos\CartDto;

final readonly class CartService
{
    public function __construct(
        private Cart $cart,
    ) {
    }

    public function store(CartDto $cartDto): Cart
    {
        if (
            Cart::query()
                ->where('product_id', $cartDto->getProductId())
                ->where('user_id', $cartDto->getUserId())
                ->exists()
        ) {
            throw new \Exception('product exists cart');
        }

        $this->cart->fill($cartDto->toArray());
        $this->cart->save();

        return $this->cart;
    }

    public function updateQuantity(int $quantity): Cart
    {
        if ($this->cart->product->quantity < $quantity) {
            throw new \Exception('quantity is out of stock');
        }

        $this->cart
            ->update([
                'quantity' => $quantity,
            ]);

        return $this->cart;
    }

    public function delete(): void
    {
        $this->cart->delete();
    }
}
