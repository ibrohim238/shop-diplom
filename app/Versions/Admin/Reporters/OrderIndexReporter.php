<?php

namespace App\Versions\Admin\Reporters;

use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class OrderIndexReporter
{
    public function execute(Request $request = null): QueryBuilder
    {
        return QueryBuilder::for(Order::class, $request)
            ->allowedFields([]);
    }
}
