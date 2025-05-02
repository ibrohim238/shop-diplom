<?php

use App\Versions\Admin\Http\Controllers\CategoryController;
use App\Versions\Admin\Http\Controllers\CouponController;
use App\Versions\Admin\Http\Controllers\OrderChartsController;
use App\Versions\Admin\Http\Controllers\OrderController;
use App\Versions\Admin\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('coupons', CouponController::class)->except(['update']);
Route::get('/orders/charts', OrderChartsController::class)->name('orders.charts');
Route::apiResource('orders', OrderController::class)->only(['index', 'show']);
