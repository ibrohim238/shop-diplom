<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderChartsController
{
    public function __invoke(Request $request)
    {
        $cacheKey = self::graphics($request);
        $data     = Cache::remember($cacheKey, config('statistics.ttl.graphics'), static function () use ($request) {
            return QueryBuilder::for(OrderItem::query())
                ->addSelect('sum(quantity) as quantity')
                ->selectSub(
                    str_replace(
                        ':format',
                        match ($request->get('format')) {
                            'week'  => 60 * 60 * 24 * 7,
                            'month' => 60 * 60 * 24 * 30,
                            'year'  => 60 * 60 * 24 * 365,
                            default => 60 * 60 * 24,
                        },
                        'to_timestamp(DIV(extract(epoch from created_at), :format) * :format)::DATE',
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
                    })
                        ->default(
                            sprintf(
                                '%s-%s',
                                Carbon::now()->subWeeks(3)->format('d/m/Y'),
                                Carbon::now()->addDay()->format('d/m/Y'),
                            ),
                        ),
                    AllowedFilter::exact('product_id'),
                    AllowedFilter::exact('category_id', 'product.categories.id'),
                ])
                ->groupBy('date')
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
