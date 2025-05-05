<?php

namespace App\Console\Commands;

use App\Enums\OrderItemReporterTypeEnum;
use App\Jobs\OrderItemGatherStatJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OrderItemReporterCommand extends Command
{
    protected $signature = 'order-item-reporter-command {--date=} {--type=}';

    protected $description = 'Сбор данных для order items';

    public function handle()
    {
        $date = Carbon::make($this->option('date')) ?? Carbon::now();
        $type = $this->option('type');

        if ($type === null) {
            OrderItemGatherStatJob::dispatch(
                $date,
                OrderItemReporterTypeEnum::PRODUCT,
            );
            OrderItemGatherStatJob::dispatch(
                $date,
                OrderItemReporterTypeEnum::CATEGORY,
            );
        }

        if (!OrderItemReporterTypeEnum::has($type)) {
            $this->error('Invalid type');

            return;
        }

        OrderItemGatherStatJob::dispatch(
            $date,
            OrderItemReporterTypeEnum::PRODUCT,
        );
    }
}
