<?php

namespace Database\Seeders;

use App\Enums\OrderItemReporterTypeEnum;
use App\Enums\RoleEnum;
use App\Jobs\OrderItemGatherStatJob;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder {
    public function run(): void
    {
        $user = User::factory()->create();
        $user->assignRole([RoleEnum::cases()]);
        $products  = Product::all();

        Order::factory()
            ->for($user)
            ->has(
                OrderItem::factory()
                    ->count( 100)
                    ->state(fn() => [
                        'created_at' => fake()->dateTimeBetween('-1 year', 'now')
                    ])
                    ->state(fn() => [
                        'product_id' => $products->random()->id,
                    ]),
                'items'
            )
            ->state(fn() => [
                'created_at' => fake()->dateTimeBetween('-1 year', 'now')
            ])
            ->count(100)
            ->create();

        $period = CarbonPeriod::create('2024-01-01', '1 day', 'now');

        foreach ($period as $date) {
            OrderItemGatherStatJob::dispatch(
                $date,
                OrderItemReporterTypeEnum::PRODUCT,
            );
            OrderItemGatherStatJob::dispatch(
                $date,
                OrderItemReporterTypeEnum::CATEGORY,
            );
        }
    }
}
