<?php

namespace App\Versions\Admin\Reporters;

use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class CategoryIndexReporter
{
    public function execute(?Request $request = null): QueryBuilder
    {
        return QueryBuilder::for(Category::class)
            ->allowedFilters([

            ]);
    }
}
