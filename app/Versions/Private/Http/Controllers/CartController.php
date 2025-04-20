<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Cart;
use App\Versions\Private\Dtos\CartDto;
use App\Versions\Private\Http\Requests\CartRequest;
use App\Versions\Private\Http\Requests\CartUpdateQuantityRequest;
use App\Versions\Private\Http\Resources\CartResource;
use App\Versions\Private\Services\CartService;
use Exception;
use Illuminate\Http\Request;

final readonly class CartController
{
    public function index(Request $request)
    {
        $products = $request
            ->user()
            ->carts()
            ->with(['product', 'product.media'])
            ->withSum('product', 'price')
            ->orderByDesc('id')
            ->paginate($request->get('limit', 15));

        return CartResource::collection($products);
    }

    public function store(
        CartRequest $request,
        CartService $service,
    ) {
        try {
            $cart = $service->store(CartDto::fromRequest($request));
        } catch (Exception $e) {
            return response()
                ->json([
                    'message' => $e->getMessage(),
                ], 400);
        }

        return CartResource::make(
            $cart
                ->load(['product', 'product.media'])
                ->loadSum('product', 'price'),
        );
    }

    public function updateQuantity(
        Cart $cart,
        CartUpdateQuantityRequest $request,
    ) {
        try {
            app(CartService::class, [
                'cart' => $cart,
            ])
                ->updateQuantity($request->quantity);
        } catch (Exception $e) {
            return response()
                ->json([
                    'message' => $e->getMessage(),
                ], 422);
        }

        return CartResource::make(
            $cart
                ->load(['product', 'product.media'])
                ->loadSum('product', 'price'),
        );
    }

    public function destroy(Cart $cart)
    {
        app(CartService::class, [
            'cart' => $cart,
        ])->delete();

        return response()->noContent();
    }
}
