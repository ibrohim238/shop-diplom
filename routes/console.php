<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\OrderItemReporterCommand;

Schedule::command(OrderItemReporterCommand::class)
    ->dailyAt('01:00');
