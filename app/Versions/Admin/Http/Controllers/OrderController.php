<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Models\Order;
use App\Versions\Private\Http\Resources\OrderResource;
use App\Versions\Private\Reporters\OrderIndexReporter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class OrderController
{
    public function index(
        Request            $request,
        OrderIndexReporter $reporter,
    ) {
        $orders = $reporter->execute()
            ->with([
                'items',
                'items.product' => fn(BelongsTo $query) => $query->withTrashed(),
                'items.product.media',
            ])
            ->paginate($request->get('limit', 15));

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        return OrderResource::make($order->load(['items.product.media', 'coupon']));
    }
}
