<?php

use App\Http\Controllers\Apps\StudentAppController;
use Illuminate\Support\Facades\Route;


Route::prefix('/app')->name('app.')->group(function () {

    Route::get('/splash', [StudentAppController::class, 'splash'])->name('splash');

    Route::controller(StudentAppController::class)->group(function () {

        Route::get('/onboard', 'onboard')->name('onboard');
        Route::get('/login', 'login')->name('login');
        Route::get('otp', 'otp')->name('withotp');
        Route::get('biometric-screen', 'biometricScreen')->name('biometric.screen');
        Route::get('student/forgot-password', 'forgetPassword')
            ->name('student.forgot_password');

        Route::prefix('student')->middleware(['auth:web'])->name('student.')->group(function () {
            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::get('quick-actions', 'quickActions')->name('quick.actions');
            Route::get('attendance', 'attendance')->name('attendance');
            Route::get('timetable', 'timetable')->name('timetable');
            Route::get('fees', 'fees')->name('fees');
            Route::get('profile', 'profile')->name('profile');
            Route::get('fee-receipt', 'feeReceipt')->name('fee_receipt');
            Route::get('leave', 'leave')->name('leave');
        });
    });
});
