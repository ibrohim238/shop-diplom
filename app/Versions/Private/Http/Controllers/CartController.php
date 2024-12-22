<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Cart;
use App\Versions\Private\Dtos\CartDto;
use App\Versions\Private\Http\Requests\CartRequest;
use App\Versions\Private\Http\Resources\CartResource;
use App\Versions\Private\Reporters\ProductIndexReporter;
use App\Versions\Private\Services\CartService;
use Illuminate\Http\Request;

final readonly class CartController
{
    public function index(Request $request)
    {
        $products = $request
            ->user()
            ->carts()
            ->with('product')
            ->orderByDesc('id')
            ->paginate($request->get('limit', 15));

        return CartResource::collection($products);
    }

    public function store(
        CartRequest $request,
        CartService $service,
    ) {
        $cart = $service->store(CartDto::fromRequest($request));

        return CartResource::make($cart->load('product'));
    }

    public function destroy(Cart $cart) {
        app(CartService::class, [
            'cart' => $cart
        ])->delete();

        return response()->noContent();
    }
}
