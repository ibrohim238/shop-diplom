<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Models\Order;
use App\Versions\Admin\Http\Resources\OrderResource;
use App\Versions\Admin\Reporters\OrderIndexReporter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class OrderController
{
    public function index(
        Request            $request,
        OrderIndexReporter $reporter,
    ) {
        $orders = $reporter->execute($request)
            ->paginate($request->get('limit', 15));

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        $order->load([
            'items',
            'items.product' => fn(BelongsTo $query) => $query->withTrashed(),
            'items.product.media',
            'coupon',
        ]);

        return OrderResource::make($order);
    }
}
