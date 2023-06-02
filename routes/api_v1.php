<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api.v1.'], function () {
    Route::group(['as' => 'auth.'], function() {
        Route::post('register', [\App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'register'])
            ->name('register');
        Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login'])
            ->name('login');
        Route::post('refresh', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'refresh'])
            ->name('refresh');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['as' => 'auth.'], function() {
            Route::get('me', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'me'])
                ->name('me');
        });

        Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
            Route::match(['PATCH', 'PUT'], 'settings', [
                \App\Http\Controllers\Api\V1\User\SettingsController::class, 'update'
            ])->name('settings.update');
        });
    });
});
