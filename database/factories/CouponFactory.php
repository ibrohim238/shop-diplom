<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(),
            'type' => $this->faker->randomNumber(),
            'code' => $this->faker->word(),
            'description' => $this->faker->text(),
            'min_price' => $this->faker->numberBetween(0, 10000),
            'quantity_allowed' => $this->faker->numberBetween(0, 100),
            'expires_at' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
