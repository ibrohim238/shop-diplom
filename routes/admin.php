<?php

use App\Versions\Admin\Http\Controllers\CategoryController;
use App\Versions\Admin\Http\Controllers\CouponController;
use App\Versions\Admin\Http\Controllers\OrderItemReporterController;
use App\Versions\Admin\Http\Controllers\OrderController;
use App\Versions\Admin\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('coupons', CouponController::class)->except(['update']);
Route::prefix('/order-item-reporters')->group(function () {
    Route::get('/charts', [OrderItemReporterController::class, 'charts'])->name('orders.charts');
    Route::get('/sum', [OrderItemReporterController::class, 'sum'])->name('orders.sum');
    Route::get('/avg', [OrderItemReporterController::class, 'avg'])->name('orders.avg');
    Route::get('/max', [OrderItemReporterController::class, 'max'])->name('orders.max');
    Route::get('/min', [OrderItemReporterController::class, 'min'])->name('orders.min');
});
Route::apiResource('orders', OrderController::class)->only(['index', 'show']);
