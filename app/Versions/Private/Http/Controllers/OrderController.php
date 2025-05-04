<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Order;
use App\Versions\Private\Dtos\OrderDto;
use App\Versions\Private\Http\Requests\OrderRequest;
use App\Versions\Private\Http\Resources\OrderResource;
use App\Versions\Private\Reporters\OrderIndexReporter;
use App\Versions\Private\Services\OrderService;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class OrderController
{
    public function index(
        Request            $request,
        OrderIndexReporter $reporter,
    ) {
        $orders = $reporter->execute()
            ->where('user_id', auth()->id())
            ->paginate($request->get('limit', 15));

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        if (!$order->user()->is(auth()->user())) {
            abort(403, 'unauthorized');
        }

        $order->load([
            'items',
            'items.product' => fn(BelongsTo $query) => $query->withTrashed(),
            'items.product.media',
            'coupon',
        ]);

        return OrderResource::make($order);
    }

    public function store(OrderRequest $request, OrderService $service)
    {
        $order = $service->store(OrderDto::fromRequest($request));

        return OrderResource::make($order->load(['items.product.media', 'coupon']));
    }
}
