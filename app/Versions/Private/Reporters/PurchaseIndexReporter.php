<?php

namespace App\Versions\Private\Reporters;

use App\Models\Purchase;
use Spatie\QueryBuilder\QueryBuilder;

class PurchaseIndexReporter
{
    public function execute(): QueryBuilder
    {
        return QueryBuilder::for(Purchase::class)
            ->allowedFields([]);
    }
}
