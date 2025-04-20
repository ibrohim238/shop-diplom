<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Order;
use App\Versions\Private\Dtos\OrderDto;
use App\Versions\Private\Http\Requests\OrderRequest;
use App\Versions\Private\Http\Resources\OrderResource;
use App\Versions\Private\Reporters\OrderIndexReporter;
use App\Versions\Private\Services\OrderService;
use Exception;
use Illuminate\Http\Request;

class OrderController
{
    public function index(
        Request            $request,
        OrderIndexReporter $reporter,
    ) {
        $orders = $reporter->execute()
            ->with(['items.product.media'])
            ->paginate($request->get('limit', 15));

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        return OrderResource::make($order->load(['items.product.media', 'coupon']));
    }

    public function store(OrderRequest $request, OrderService $service)
    {
        try {
            $order = $service->store(OrderDto::fromRequest($request));

            return OrderResource::make($order->load(['items.product.media', 'coupon']));
        } catch (Exception $e) {
            return response()
                ->json([
                    'error' => $e->getMessage(),
                ], 422);
        }

    }
}
