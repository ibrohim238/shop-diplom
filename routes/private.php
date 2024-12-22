<?php

use App\Versions\Private\Http\Controllers\BasketController;
use App\Versions\Private\Http\Controllers\CategoryController;
use App\Versions\Private\Http\Controllers\ProductController;
use App\Versions\Private\Http\Controllers\PurchaseController;
use App\Versions\Private\Http\Controllers\UserMediaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require('admin.php');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
        Route::get('', [UserMediaController::class, 'index'])->name('index');
        Route::post('', [UserMediaController::class, 'store'])->name('store');
        Route::delete('', [UserMediaController::class, 'destroy'])->name('destroy');
    });
    Route::apiResource('baskets', BasketController::class)
        ->middleware('auth:api')
        ->only(['index', 'store', 'destroy']);
    Route::group(['prefix' => 'purchases', 'as' => 'purchases.'], function () {
        Route::get('', [PurchaseController::class, 'index'])
            ->name('index');
        Route::post('', [PurchaseController::class, 'store'])
            ->name('store');
    });
});

Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
