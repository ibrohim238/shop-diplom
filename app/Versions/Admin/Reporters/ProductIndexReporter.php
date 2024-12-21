<?php

namespace App\Versions\Admin\Reporters;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
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
