<?php

use App\Versions\Private\Http\Controllers\BasketController;
use App\Versions\Private\Http\Controllers\CategoryController;
use App\Versions\Private\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require('admin.php');
});

Route::apiResource('baskets', BasketController::class)->only(['index', 'store', 'destroy']);
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

