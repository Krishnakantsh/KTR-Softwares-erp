<?php

use App\Http\Controllers\AttendanceMasterController;
use App\Http\Controllers\OnlineClassController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->middleware(['auth'])->group(function () {

    // for admin route methods

    Route::prefix('v1')->group(function () {

        Route::prefix('student')->name('student.')->group(function () {

            Route::controller(StudentController::class)->prefix('registration')
                ->name('registration.')->group(function () {
                    Route::get('/', 'index')->name('index');

                    Route::put('/status', 'status')->name('status');
                    Route::post('/save', 'store')->name('save');
                });


            Route::controller(StudentController::class)->group(function () {
                Route::get('/assign_roll_no', 'assign_roll_no')->name('assign_roll_no');
                Route::get('/show-student-by-id', 'showWith')->name('show.with');
                Route::get('/get-students', 'fetch')->name('fetch');
            });

            Route::controller(OnlineClassController::class)->prefix('online-classes')
                ->name('online_classes.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/with-subjects', 'with_subjects')->name('with_subjects');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(AttendanceMasterController::class)->prefix('attendance')
                ->name('attendance.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch-students', 'fetchStudents')->name('fetch_students');
                    Route::get('/get-attendence-data', 'get_attendence_data')->name('get_attendence_data');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/with-subjects', 'with_subjects')->name('with_subjects');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });
        });
    });
});
