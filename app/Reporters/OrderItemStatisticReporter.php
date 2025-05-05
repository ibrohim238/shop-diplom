<?php

namespace App\Reporters;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OrderItemStatisticReporter
{
    public function gatherStatsByProduct(array $period, Product $product): ?array
    {
        return (array) $this->base()
            ->whereBetween('order_items.created_at', $period)
            ->where('order_items.product_id', $product->id)
            ->toBase()
            ->first();
    }

    public function gatherStatsByCategory(array $period, Category $category): ?array
    {
        return (array) $this->base()
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->whereBetween('order_items.created_at', $period)
            ->where('category_product.category_id', $category->id)
            ->toBase()
            ->first();
    }

    private function base(): Builder
    {
        return OrderItem::query()
            ->select([
                DB::raw('sum(order_items.quantity) as quantity'),
                DB::raw('sum(order_items.total_amount) as total_amount'),
            ]);
    }
}
