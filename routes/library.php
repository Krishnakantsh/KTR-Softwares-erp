<?php

use App\Http\Controllers\LibraryAuthorController;
use App\Http\Controllers\LibraryBookController;
use App\Http\Controllers\LibraryCategoryController;
use App\Http\Controllers\LibraryFineController;
use App\Http\Controllers\LibraryPublicationController;
use App\Http\Controllers\LibrarySupplierController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware(['auth'])->group(function () {



    Route::prefix('v1')->group(function () {

        Route::prefix('school/library')->name('school.library.')->group(function () {

            Route::controller(LibraryAuthorController::class)->prefix('author')
                ->name('author.')->group(function () {

                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });
            Route::controller(LibraryPublicationController::class)->prefix('publication')
                ->name('publication.')->group(function () {

                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });
            Route::controller(LibraryCategoryController::class)->prefix('category')
                ->name('category.')->group(function () {

                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });
            Route::controller(LibraryFineController::class)->prefix('fine-setup')
                ->name('fine.')->group(function () {

                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });
            Route::controller(LibrarySupplierController::class)->prefix('supplier')
                ->name('supplier.')->group(function () {

                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(LibraryBookController::class)->prefix('book')
                ->name('book.')->group(function () {

                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
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

Route::get('/testing', function () {
    return view('Frontend/Normal/Pages/Library/LibraryMaster/main');
});
