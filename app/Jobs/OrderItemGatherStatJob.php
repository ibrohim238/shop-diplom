<?php

namespace App\Jobs;

use App\Enums\OrderItemReporterTypeEnum;
use App\Models\Category;
use App\Models\OrderItemReporter;
use App\Models\Product;
use App\Reporters\OrderItemStatisticReporter;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class OrderItemGatherStatJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Carbon $date,
        private readonly OrderItemReporterTypeEnum $type,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        match ($this->type) {
            OrderItemReporterTypeEnum::PRODUCT => $this->forTypeProduct(),
            OrderItemReporterTypeEnum::CATEGORY => $this->forTypeCategory(),
        };
    }

    private function forTypeProduct(): void
    {
        $period = [
            $this->date->copy()->startOfDay(),
            $this->date->copy()->endOfDay(),
        ];

        Product::query()
            ->chunkById(100, function (Collection $products) use ($period) {
                $products->each(function (Product $product) use ($period) {
                    $data = app(OrderItemStatisticReporter::class)
                        ->gatherStatsByProduct(
                            $period,
                            $product,
                        );

                    $reporter = (new OrderItemReporter());
                    $reporter->firstOrCreate([
                        'date' => $this->date,
                        'model_type' => $this->type->value,
                        'model_id' => $product->id,
                    ], [
                        'total_amount' => $data['total_amount'] ?? 0,
                        'quantity' => $data['quantity'] ?? 0,
                    ]);
                });
            });
    }

    private function forTypeCategory(): void
    {
        $period = [
            $this->date->copy()->startOfDay(),
            $this->date->copy()->endOfDay(),
        ];

        Category::query()
            ->chunkById(100, function (Collection $categories) use ($period) {
                $categories->each(function (Category $category) use ($period) {
                    $data = app(OrderItemStatisticReporter::class)
                        ->gatherStatsByCategory(
                            $period,
                            $category,
                        );

                    $reporter = (new OrderItemReporter());
                    $reporter->model()->associate($category);
                    $reporter->firstOrCreate([
                        'date' => $this->date,
                        'model_type' => $this->type->value,
                        'model_id' => $category->id,
                    ], [
                        'total_amount' => $data['total_amount'] ?? 0,
                        'quantity' => $data['quantity'] ?? 0,
                    ]);
                });
            });
    }
}
