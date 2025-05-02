<?php

namespace App\Versions\Admin\Http\Controllers;

use App\Models\Coupon;
use App\Versions\Admin\Dtos\CouponDto;
use App\Versions\Admin\Http\Requests\CouponRequest;
use App\Versions\Admin\Http\Resources\CouponResource;
use App\Versions\Admin\Reporters\CouponIndexReporter;
use App\Versions\Admin\Services\CouponService;
use Illuminate\Http\Request;

class CouponController
{
    public function index(Request $request, CouponIndexReporter $reporter)
    {
        $coupons = $reporter
            ->execute()
            ->paginate($request->get('limit', 15));

        return CouponResource::collection($coupons);
    }

    public function show(Coupon $coupon)
    {
        return new CouponResource($coupon->load('orders'));
    }

    public function store(CouponRequest $request, CouponService $service)
    {
        $coupon = $service->store(CouponDto::fromRequest($request));

        return CouponResource::make($coupon);
    }

    public function destroy(Coupon $coupon)
    {
        app(CouponService::class, [
            'coupon' => $coupon,
        ])->delete();

        return response()->noContent();
    }
}
