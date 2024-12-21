<?php

use App\Versions\Private\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    require('admin.php');
});

Route::apiResource('products', ProductController::class)->only(['index', 'show']);
