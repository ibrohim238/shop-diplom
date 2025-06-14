<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Enums\OrderItemReporterTypeEnum;
use App\Models\OrderItemReporter;
use App\Versions\Admin\Http\Resources\OrderItemReporterChartResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderItemReporterController
{
    public function charts(Request $request)
    {
        $data = QueryBuilder::for(OrderItemReporter::query(), $request)
            ->select([
                DB::raw('sum(quantity) as quantity'),
                DB::raw('sum(total_amount) as total_amount')
            ])
            ->selectSub(
                str_replace(
                    ':format',
                    match ($request->get('format')) {
                        'week'  => 60 * 60 * 24 * 7,
                        'month' => 60 * 60 * 24 * 30,
                        'year'  => 60 * 60 * 24 * 365,
                        default => 60 * 60 * 24,
                    },
                    'to_timestamp(DIV(extract(epoch from date), :format) * :format)::DATE',
                ),
                'truncated_date',
            )
            ->allowedFilters([
                AllowedFilter::callback('date', function (Builder $query, mixed $value) {
                    [$min, $max] = $value;

                    $query->whereBetween('date', [
                        Carbon::make($min)->startOfDay(),
                        Carbon::make($max)->endOfDay(),
                    ]);
                }),
                AllowedFilter::callback('type', function (Builder $query, mixed $value) {
                    if (!OrderItemReporterTypeEnum::has($value)) {
                        return;
                    }

                    $query->where('model_type', OrderItemReporterTypeEnum::from($value));
                }),
                AllowedFilter::exact('model_id')
            ])
            ->groupBy('truncated_date')
            ->toBase()
            ->get();

        return OrderItemReporterChartResource::collection($data);
    }

    public function sum()
    {
        $data = QueryBuilder::for(OrderItemReporter::query())
            ->select([
                DB::raw('sum(quantity) as quantity'),
                DB::raw('sum(total_amount) as total_amount')
            ])
            ->allowedFilters([
                AllowedFilter::callback('date', function (Builder $query, mixed $value) {
                    [$min, $max] = $value;

                    $query->whereBetween('date', [
                        Carbon::make($min)->startOfDay(),
                        Carbon::make($max)->endOfDay(),
                    ]);
                }),
                AllowedFilter::callback('type', function (Builder $query, mixed $value) {
                    if (!OrderItemReporterTypeEnum::has($value)) {
                        return;
                    }

                    $query->where('model_type', OrderItemReporterTypeEnum::from($value));
                }),
                AllowedFilter::exact('model_id')
            ])
            ->toBase()
            ->first();

        return response()->json(compact('data'));
    }

    public function avg()
    {
        $data = QueryBuilder::for(OrderItemReporter::query())
            ->select([
                DB::raw('avg(quantity)::numeric(12,2) as quantity'),
                DB::raw('avg(total_amount)::numeric(12,2) as total_amount')
            ])
            ->allowedFilters([
                AllowedFilter::callback('date', function (Builder $query, mixed $value) {
                    [$min, $max] = $value;

                    $query->whereBetween('date', [
                        Carbon::make($min)->startOfDay(),
                        Carbon::make($max)->endOfDay(),
                    ]);
                }),
                AllowedFilter::callback('type', function (Builder $query, mixed $value) {
                    if (!OrderItemReporterTypeEnum::has($value)) {
                        return;
                    }

                    $query->where('model_type', OrderItemReporterTypeEnum::from($value));
                }),
                AllowedFilter::exact('model_id')
            ])
            ->toBase()
            ->first();

        return response()->json(compact('data'));
    }

    public function max()
    {
        $data = QueryBuilder::for(OrderItemReporter::query())
            ->select([
                DB::raw('max(quantity) as quantity'),
                DB::raw('max(total_amount) as total_amount')
            ])
            ->allowedFilters([
                AllowedFilter::callback('date', function (Builder $query, mixed $value) {
                    [$min, $max] = $value;

                    $query->whereBetween('date', [
                        Carbon::make($min)->startOfDay(),
                        Carbon::make($max)->endOfDay(),
                    ]);
                }),
                AllowedFilter::callback('type', function (Builder $query, mixed $value) {
                    if (!OrderItemReporterTypeEnum::has($value)) {
                        return;
                    }

                    $query->where('model_type', OrderItemReporterTypeEnum::from($value));
                }),
                AllowedFilter::exact('model_id')
            ])
            ->toBase()
            ->first();

        return response()->json(compact('data'));
    }

    public function min()
    {
        $data = QueryBuilder::for(OrderItemReporter::query())
            ->select([
                DB::raw('min(quantity) as quantity'),
                DB::raw('min(total_amount) as total_amount')
            ])
            ->allowedFilters([
                AllowedFilter::callback('date', function (Builder $query, mixed $value) {
                    [$min, $max] = $value;

                    $query->whereBetween('date', [
                        Carbon::make($min)->startOfDay(),
                        Carbon::make($max)->endOfDay(),
                    ]);
                }),
                AllowedFilter::callback('type', function (Builder $query, mixed $value) {
                    if (!OrderItemReporterTypeEnum::has($value)) {
                        return;
                    }

                    $query->where('model_type', OrderItemReporterTypeEnum::from($value));
                }),
                AllowedFilter::exact('model_id')
            ])
            ->toBase()
            ->first();

        return response()->json(compact('data'));
    }
}
