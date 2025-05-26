<?php

namespace App\Console\Commands;

use App\Enums\OrderItemReporterTypeEnum;
use App\Jobs\OrderItemGatherStatJob;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PHPHtmlParser\Dom;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;

class ParseDataCommand extends Command
{
    protected $signature = 'parse-data-command';

    protected $description = 'Command description';

    public function handle(): int
    {
        $user = User::factory()->create();
        $data = [
            'materinskie-platy' => 'материнские платы',
            'operativnaya-pamyat-dimm' => 'оперативная память DIMM',
            'bloki-pitaniya' => 'блоки питания',
            'korpusa' => 'корпуса',
            'kulery-dlya-processorov' => 'кулеры для процессора',
            'sistemy-zhidkostnogo-ohlazhdeniya' => 'системы жидкостного охлаждения',
            'ventilyatory-dlya-korpusa' => 'вентиляторы для корпуса',
            'ssd-m2-nakopiteli' => 'ссд',
            'monitory' => 'мониторы',
            'radiosistemy' => 'радиосистема',
            'aksessuary-dlya-materinskix-plat' => 'аксесуары для материнской платы',
            'karty-videozaxvata' => 'карты видеозахвата',
        ];

        $dayDates = CarbonPeriod::create('2025-05-01', '1 day', 'now');
        $monthDates = CarbonPeriod::create('2024-01-01', '1 month', '2025-04-01');
        $yearDates = CarbonPeriod::create('2018-01-01', '1 year', '2025-01-01');

        foreach ($data as $key => $item) {
            $category = Category::create([
                'name' => $item,
            ]);
            $dom = new Dom();
            $dom->loadFromFile(storage_path('/pars_data/' . $key . '.html'));
            $contents = $dom->find('.catalog-product');;
            foreach ($contents as $content) {
                $imgUrl = $content->find('img', 0)->getAttribute('src');
                $name = $content->find('.catalog-product__name-wrapper a.catalog-product__name span', 0)->text;
                $price = preg_replace('/\D+/', '', $content->find('.product-buy__price', 0)->text);
                $product = Product::create([
                    'name' => $name,
                    'price' => $price,
                ]);
                $product->categories()->attach($category);
                if ($imgUrl !== null) {
                    try {
                        $product->addMediaFromUrl($imgUrl)->toMediaCollection();
                    } catch (UnreachableUrl) {
                        $this->info('Unreachable url');;
                    }
                }

                $this->createOrder($dayDates, $product->price, $product, 'day', $user);
                $this->createOrder($monthDates, $product->price, $product, 'month', $user);
                $this->createOrder($yearDates, $product->price, $product, 'week', $user);
            }
        }

        $this->callReporter($dayDates);
        $this->callReporter($monthDates);
        $this->callReporter($yearDates);

        return self::SUCCESS;
    }

    /**
     * @param CarbonPeriod $dates
     * @param float|int $price
     * @param Product $product
     * @param string $type
     * @param User $user
     * @return void
     */
    private function createOrder(CarbonPeriod $dates, float|int $price, Product $product, string $type, User $user): void
    {
        foreach ($dates as $date) {
            $quantity = match ($type) {
                'day' => rand(2, 30),
                'month' => rand(100, 400),
                'week' => rand(800, 2000),
            };
            $totalAmount = $quantity * $price;
            $orderId = DB::table('orders')->insertGetId([
                'total_amount' => $totalAmount,
                'user_id' => $user->id,
                'status' => 0,
                'created_at' => $date->toDateString(),
                'updated_at' => $date->toDateString(),
            ]);
            DB::table('order_items')->insert([
                'product_id' => $product->id,
                'order_id' => $orderId,
                'quantity' => $quantity,
                'total_amount' => $totalAmount,
                'created_at' => $date->toDateString(),
                'updated_at' => $date->toDateString(),
            ]);
        }
    }

    private function callReporter(CarbonPeriod $dates): void
    {
        foreach ($dates as $date) {
            OrderItemGatherStatJob::dispatch(
                $date,
                OrderItemReporterTypeEnum::PRODUCT,
            );
            OrderItemGatherStatJob::dispatch(
                $date,
                OrderItemReporterTypeEnum::CATEGORY,
            );
        }
    }

}
