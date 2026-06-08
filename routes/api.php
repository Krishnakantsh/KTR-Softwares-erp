<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TotalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function () {
    Route::prefix('admin')->group(function () {


        Route::prefix('school')->name('school.')->controller(SchoolController::class)->group(function () {
            Route::post('store', 'store')->name('store');
        });
    });
});
