<?php

namespace App\Versions\Private\Services;


use App\Exceptions\BasketException;
use App\Models\Product;
use App\Models\User;

final readonly class BasketService
{
    /**
     * @throws BasketException
     */
    public function attach(User $user, Product $product): void
    {
        if ($user->products()->where('id', $product->id)->exists()) {
            throw BasketException::exists();
        }

        $user->products()->attach($product);
    }

    /**
     * @throws BasketException
     */
    public function detach(User $user, Product $product): void
    {
        if (!$user->products()->where('id', $product->id)->exists()) {
            throw BasketException::notExists();
        }

        $user->products()->detach($product);
    }
}
