<?php

namespace App\Versions\Private\Http\Controllers;

use App\Versions\Private\Dtos\OrderDto;
use App\Versions\Private\Http\Requests\OrderRequest;
use App\Versions\Private\Services\PreviewOrderService;

class PreviewOrderController
{
    public function __invoke(
        OrderRequest $request,
    ) {
        $preview = app(PreviewOrderService::class)
            ->preview(OrderDto::fromRequest($request));

        return response()->json([
            'data' => $preview,
        ]);
    }
}
