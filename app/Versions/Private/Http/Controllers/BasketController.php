<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Product;
use App\Versions\Private\Http\Resources\ProductResource;
use App\Versions\Private\Reporters\ProductIndexReporter;
use App\Versions\Private\Services\BasketService;
use Illuminate\Http\Request;

final readonly class BasketController
{
    public function index(Request $request, ProductIndexReporter $reporter)
    {
        $products = $reporter
            ->execute()
            ->select('product.*')
            ->join('baskets', 'products.id', '=', 'baskets.product_id')
            ->orderByDesc('baskets.id')
            ->paginate($request->get('limit', 15));

        return ProductResource::collection($products);
    }

    public function attach(
        Product $product,
        Request $request,
        BasketService $service
    ) {
        $service->attach($request->user(), $product);

        return response()->noContent();
    }

    public function detach(
        Product $product,
        Request $request,
        BasketService $service
    ) {
        $service->detach($request->user(), $product);

        return response()->noContent();
    }
}
