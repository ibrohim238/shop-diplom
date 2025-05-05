<?php

namespace Database\Factories;

use App\Models\OrderItemReporter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderItemReporterFactory extends Factory{
    protected $model = OrderItemReporter::class;

    public function definition(): array
    {
        return [
            'date' => Carbon::now(),
            'total_amount' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
