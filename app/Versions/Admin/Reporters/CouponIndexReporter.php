<?php

namespace App\Versions\Admin\Reporters;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

final readonly class CouponIndexReporter
{
    public function execute(?Request $request = null): QueryBuilder
    {
        return QueryBuilder::for(Coupon::class)
            ->allowedFilters([

            ]);
    }
}
