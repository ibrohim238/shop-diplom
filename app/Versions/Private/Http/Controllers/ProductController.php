<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Product;
use App\Versions\Private\Http\Resources\ProductResource;
use App\Versions\Private\Reporters\ProductIndexReporter;
use Illuminate\Http\Request;

final readonly class ProductController
{
    public function index(Request $request, ProductIndexReporter $reporter)
    {
        $products = $reporter
            ->execute()
            ->paginate($request->get('limit', 15));

        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        return ProductResource::make($product);
    }
}
