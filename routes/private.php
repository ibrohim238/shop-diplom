<?php

use App\Versions\Private\Http\Controllers\CartController;
use App\Versions\Private\Http\Controllers\CategoryController;
use App\Versions\Private\Http\Controllers\ProductController;
use App\Versions\Private\Http\Controllers\OrderController;
use App\Versions\Private\Http\Controllers\RegisterController;
use App\Versions\Private\Http\Controllers\ProfileController;
use App\Versions\Private\Http\Controllers\UserMediaController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:admin'], function () {
    require('admin.php');
});

Route::post('register', RegisterController::class)
    ->middleware('guest')
    ->name('register');
Route::post('/oauth/token/', [AuthorizedAccessTokenController::class, 'forUser'])->name('oauth.token');

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:api', 'role:user']], function () {
    Route::get('', ProfileController::class)->name('profile');
    Route::apiResource('media', UserMediaController::class)
        ->only(['index', 'store', 'destroy']);
    Route::apiResource('carts', CartController::class)
        ->only(['index', 'store', 'destroy']);
    Route::apiResource('orders', OrderController::class)
        ->only('index', 'show', 'store');
});

Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
