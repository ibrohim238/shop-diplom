<?php

namespace App\Versions\Admin\Reporters;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class ProductIndexReporter
{
    public function execute(?Request $request = null): QueryBuilder
    {
        return QueryBuilder::for(Product::class)
            ->with('media')
            ->allowedFilters([
                AllowedFilter::exact('category_slug', 'categories.slug'),
                AllowedFilter::exact('category_id', 'categories.id'),
            ]);
    }
}
