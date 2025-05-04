<?php

namespace App\Versions\Admin\Reporters;

use App\Models\Order;
use Spatie\QueryBuilder\QueryBuilder;

class OrderIndexReporter
{
    public function execute(): QueryBuilder
    {
        return QueryBuilder::for(Order::class)
            ->allowedFields([]);
    }
}
