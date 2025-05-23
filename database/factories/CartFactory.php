<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


/* @mixin Cart */
class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomNumber(),

            'product_id' => Product::factory(),
            'user_id' => User::factory(),
        ];
    }
}
