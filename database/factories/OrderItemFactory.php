<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/* @mixin OrderItem */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(0,100),
            'total_amount' => $this->faker->numberBetween(0,10000),

            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
