<?php

namespace App\Console\Commands;

use App\Enums\OrderItemReporterTypeEnum;
use App\Jobs\OrderItemGatherStatJob;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;

class OrderItemReporterCommand extends Command
{
    protected $signature = 'order-item-reporter-command {--date=} {--type=}';

    protected $description = 'Сбор данных для order items';

    public function handle(): void
    {
        $date = Carbon::make($this->option('date')) ?? Carbon::now()->subMonth();

        $start  = $date->copy()->startOfMonth();
        $end    = $date->copy()->endOfMonth();

        $period = CarbonPeriod::create($start, '1 day', $end);

        foreach ($period as $q) {
            OrderItemGatherStatJob::dispatch($q, OrderItemReporterTypeEnum::PRODUCT);
            OrderItemGatherStatJob::dispatch($q, OrderItemReporterTypeEnum::CATEGORY);
        }

    }
}
