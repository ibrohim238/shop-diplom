<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @mixin Factory<Order> */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'total_amount' => $this->faker->randomFloat(),
            'status' => $this->faker->randomElement(OrderStatusEnum::values()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
            'coupon_id' => $this->faker->randomElement([Coupon::factory(), null]),
        ];
    }
}
