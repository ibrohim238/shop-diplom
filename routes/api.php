<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'private', 'as' => 'private.'], function () {
    require('private.php');
});
