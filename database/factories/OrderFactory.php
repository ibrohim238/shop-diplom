<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


/* @mixin Order */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'total_amount' => $this->faker->randomFloat(),
            'status' => $this->faker->randomElement(OrderStatusEnum::values()),

            'user_id' => User::factory(),
            'coupon_id' => null,
        ];
    }
}
