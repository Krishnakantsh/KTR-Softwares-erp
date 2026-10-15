<?php

use App\Http\Controllers\Payroll\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->middleware(['auth'])->group(function () {

    Route::prefix('v1')->group(function () {

        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
        });
    });
});
