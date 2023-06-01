<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.v1.'], function () {
    Route::post('register', [\App\Http\Controllers\Api\V1\RegisterController::class, 'register'])
        ->name('register');
});
