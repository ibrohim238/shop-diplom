<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Models\Product;
use App\Versions\Admin\Dtos\ProductDto;
use App\Versions\Admin\Http\Requests\ProductRequest;
use App\Versions\Admin\Http\Resources\ProductResource;
use App\Versions\Admin\Reporters\ProductIndexReporter;
use App\Versions\Admin\Services\ProductService;
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
        $product->load(['media', 'categories']);

        return ProductResource::make($product);
    }

    public function store(ProductService $service, ProductRequest $request)
    {
        $product = $service->store(ProductDto::fromRequest($request));
        $product->load(['media', 'categories']);

        return ProductResource::make($product);
    }

    public function update(Product $product, ProductRequest $request)
    {
        $product->load(['media', 'categories']);

        app(ProductService::class, [
            'product' => $product,
        ])
            ->update(ProductDto::fromRequest($request));

        return ProductResource::make($product);
    }

    public function destroy(Product $product)
    {
        app(ProductService::class, [
            'product' => $product,
        ])
            ->delete($product);
    }
}
