<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    public function run()
    {
        $categories = Category::factory()->count(10)->create();

        Product::factory()
            ->hasAttached($categories)
            ->count(10)
            ->create();
    }
}
