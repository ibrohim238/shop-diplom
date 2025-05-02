<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderChartsController
{
    public function __invoke(Request $request)
    {
        $cacheKey = self::graphics($request);
        $data     = Cache::remember($cacheKey, config('statistics.ttl.graphics'), static function () use ($request) {

            return QueryBuilder::for(OrderItem::query())
                ->addSelect(DB::raw('sum(order_items.quantity) as quantity'))
                ->selectSub(
                    str_replace(
                        ':format',
                        match ($request->get('format')) {
                            'week'  => 60 * 60 * 24 * 7,
                            'month' => 60 * 60 * 24 * 30,
                            'year'  => 60 * 60 * 24 * 365,
                            default => 60 * 60 * 24,
                        },
                        'to_timestamp(DIV(extract(epoch from order_items.created_at), :format) * :format)::DATE',
                    ),
                    'date',
                )
                ->allowedFilters([
                    AllowedFilter::callback('period', function (Builder $query, mixed $value) {
                        [$min, $max] = explode('-', $value, 2);

                        $query->whereBetween('created_at', [
                            Carbon::make($min)->startOfDay(),
                            Carbon::make($max)->endOfDay(),
                        ]);
                    }),
                    AllowedFilter::exact('product_id'),
                    AllowedFilter::exact('category_id', 'product.categories.id'),
                ])
                ->when(
                    $request->get('group_by'),
                    function (Builder $query, mixed $value) {
                        match ($value) {
                            'category' => $query
                                ->addSelect('category_product.category_id')
                                ->join('products', 'products.id', '=', 'order_items.product_id')
                                ->join('category_product', 'category_product.product_id', '=', 'products.id')
                                ->groupBy('category_product.category_id', 'date'),
                            default => $query
                                ->addSelect('order_items.product_id')
                                ->groupBy('product_id', 'date')
                        };
                    },
                    function (Builder $query) {
                        $query
                            ->addSelect('order_items.product_id')
                            ->groupBy('product_id', 'date');
                    },
                )
                ->orderBy('date')
                ->toBase()
                ->get();
        });

        return response()->json(compact('data'));
    }

    public static function graphics(Request $request): string
    {
        return sprintf('stat_graphics:%s', self::generateUniqueQueryString($request));
    }

    private static function generateUniqueQueryString(Request $request): string
    {
        $queryParams = $request->query();
        ksort($queryParams);

        return md5(http_build_query($queryParams));
    }
}
