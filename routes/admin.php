<?php

use App\Versions\Admin\Http\Controllers\CategoryController;
use App\Versions\Admin\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
