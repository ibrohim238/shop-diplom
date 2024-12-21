<?php

namespace App\Versions\Private\Reporters;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class ProductIndexReporter
{
    public function execute(?Request $request = null): QueryBuilder
    {
        return QueryBuilder::for(Product::class)
            ->allowedFilters([

            ]);
    }
}
