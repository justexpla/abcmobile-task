<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.v1.'], function () {
    Route::group(['as' => 'auth.'], function() {
        Route::post('register', [\App\Http\Controllers\Api\V1\RegisterController::class, 'register'])
            ->name('register');
        Route::post('login', [\App\Http\Controllers\Api\V1\LoginController::class, 'login'])
            ->name('login');
        Route::post('refresh', [\App\Http\Controllers\Api\V1\LoginController::class, 'refresh'])
            ->name('refresh');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('me', [\App\Http\Controllers\Api\V1\LoginController::class, 'me'])
                ->name('me');
        });
    });
});
