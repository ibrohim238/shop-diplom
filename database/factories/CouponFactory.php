<?php

namespace Database\Factories;

use App\Enums\CouponTypeEnum;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;


/* @mixin Coupon */
class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(),
            'type' => $this->faker->randomElement(CouponTypeEnum::values()),
            'code' => $this->faker->unique()->word(),
            'description' => $this->faker->text(),
            'min_price' => $this->faker->numberBetween(0, 10000),
            'quantity_allowed' => $this->faker->numberBetween(0, 100),
            'expires_date' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
