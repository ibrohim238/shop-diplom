<?php

namespace App\Versions\Private\Http\Controllers;

use App\Models\Purchase;
use App\Versions\Private\Dtos\PurchaseDto;
use App\Versions\Private\Http\Requests\PurchaseRequest;
use App\Versions\Private\Http\Resources\PurchaseResource;
use App\Versions\Private\Reporters\PurchaseIndexReporter;
use App\Versions\Private\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchaseController
{
    public function index(
        Request $request,
        PurchaseIndexReporter $reporter
    ) {
        $purchases = $reporter->execute()
            ->paginate($request->get('limit', 15));

        return PurchaseResource::collection($purchases);
    }

    public function show(Purchase $purchase)
    {
        return PurchaseResource::make($purchase->load(['products', 'coupon']));
    }

    public function store(PurchaseRequest $request, PurchaseService $service)
    {
        $purchase = $service->store(PurchaseDto::fromRequest($request));

        return PurchaseResource::make($purchase->load(['products', 'coupon']));
    }
}
