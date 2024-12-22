<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Basket;
use App\Versions\Private\Dtos\BasketDto;
use App\Versions\Private\Http\Requests\BasketRequest;
use App\Versions\Private\Http\Resources\BasketResource;
use App\Versions\Private\Reporters\ProductIndexReporter;
use App\Versions\Private\Services\BasketService;
use Illuminate\Http\Request;

final readonly class BasketController
{
    public function index(Request $request)
    {
        $products = $request
            ->user()
            ->baskets()
            ->orderByDesc('id')
            ->paginate($request->get('limit', 15));

        return BasketResource::collection($products);
    }

    public function store(
        BasketRequest $request,
        BasketService $service,
    ) {
        $basket = $service->store(BasketDto::fromRequest($request));

        return BasketResource::make($basket);
    }

    public function destroy(Basket $basket) {
        app(BasketService::class, [
            'basket' => $basket
        ])->delete();

        return response()->noContent();
    }
}
