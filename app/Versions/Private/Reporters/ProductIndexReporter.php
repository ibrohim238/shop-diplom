<?php

namespace App\Versions\Private\Reporters;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class ProductIndexReporter
{
    public function execute(?Request $request = null): QueryBuilder
    {
        return QueryBuilder::for(Product::class, $request)
            ->with('media')
            ->allowedFilters([
                AllowedFilter::exact('category_id', 'categories.id'),
            ]);
    }
}
