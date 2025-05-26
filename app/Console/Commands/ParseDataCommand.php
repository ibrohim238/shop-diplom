<?php

namespace App\Console\Commands;

use App\Enums\OrderItemReporterTypeEnum;
use App\Jobs\OrderItemGatherStatJob;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PHPHtmlParser\Dom;

class ParseDataCommand extends Command
{
    protected $signature = 'parse-data-command';

    protected $description = 'Command description';

    public function handle(): int
    {
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
                    $product->addMediaFromUrl($imgUrl)->toMediaCollection();
                }
                $quantity = rand(2, 30);
                $totalAmount = $price * $quantity;

                $this->createOrder($dayDates, $totalAmount, $product, rand(2, 30));
                $this->createOrder($monthDates, $totalAmount, $product, rand(100, 400));
                $this->createOrder($yearDates, $totalAmount, $product, rand(1000, 5000));
            }
        }

        $this->callReporter($dayDates);
        $this->callReporter($monthDates);
        $this->callReporter($yearDates);

        return self::SUCCESS;
    }

    /**
     * @param CarbonPeriod $dates
     * @param float|int $totalAmount
     * @param Product $product
     * @param int $quantity
     * @return void
     */
    private function createOrder(CarbonPeriod $dates, float|int $totalAmount, Product $product, int $quantity): void
    {
        foreach ($dates as $date) {
            $orderId = DB::table('orders')->insertGetId([
                'total_amount' => $totalAmount,
                'user_id' => User::inRandomOrder()->value('id'),
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
