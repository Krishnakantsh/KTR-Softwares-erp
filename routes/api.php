<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Payroll\DepartmentController;
use App\Http\Controllers\Payroll\DesignationController;

/*
|--------------------------------------------------------------------------
| Public API
|--------------------------------------------------------------------------
*/

Route::post('/v1/register', [AuthController::class, 'register']);

Route::post('/v1/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected API
|--------------------------------------------------------------------------
*/


Route::middleware(['auth:api', 'subscription'])->prefix('v1')->name('v1.')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);

    // baaki protected routes

    Route::controller(DepartmentController::class)->prefix('department')->name('department.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/get-designations', 'get_designations')->name('get_designations');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
        Route::get('/show-with', 'showWith')->name('get.with');
        Route::put('/status', 'status')->name('status');
        Route::get('/show', 'show')->name('get');
        Route::post('/store', 'store')->name('save');
        Route::delete('/delete', 'destroy')->name('delete');
    });


    Route::controller(DesignationController::class)->prefix('designation')->name('designation.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/fetch', 'fetch')->name('fetch');
        Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
        Route::get('/show-with', 'showWith')->name('get.with');
        Route::put('/status', 'status')->name('status');
        Route::get('/show', 'show')->name('get');
        Route::post('/store', 'store')->name('save');
        Route::delete('/delete', 'destroy')->name('delete');
    });
});

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
