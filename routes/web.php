<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ActorController;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationMiddleware;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
], function () {
    Route::group(['prefix' => '/'], function () {
        Route::get('/register', [StudentController::class, 'create'])->name('register');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::post('/actors', [ActorController::class, 'bornInSameDay'])->name('actors');

    });
});


