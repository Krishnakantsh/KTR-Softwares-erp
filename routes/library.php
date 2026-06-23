<?php

use App\Http\Controllers\LibraryAuthorController;
use App\Http\Controllers\LibraryBookController;
use App\Http\Controllers\LibraryCardDesignerController;
use App\Http\Controllers\LibraryCategoryController;
use App\Http\Controllers\LibraryFineController;
use App\Http\Controllers\LibraryIssueController;
use App\Http\Controllers\LibraryMembershipController;
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
                    Route::post('/get-book-by-barcode-token', 'get_book_by_barcode_token')->name('get_book_by_barcode_token');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(LibraryMembershipController::class)->prefix('membership')
                ->name('membership.')->group(function () {
                    Route::get('/', 'index')->name('index');
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

            Route::controller(LibraryIssueController::class)->prefix('book_issue')
                ->name('book_issue.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');

                    Route::post('/return-book', 'returnBook')->name('return_book');
                    Route::post('/renew-book', 'renewBook')->name('renew_book');

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



Route::prefix('library-card')->name('library_card.')->group(function () {

    Route::get(
        '/designer',
        [LibraryCardDesignerController::class, 'index']
    )->name('index');

    Route::post(
        '/save-template',
        [LibraryCardDesignerController::class, 'saveTemplate']
    );

    Route::get(
        '/template/{id}',
        [LibraryCardDesignerController::class, 'getTemplate']
    );

    Route::delete(
        '/template/{id}',
        [LibraryCardDesignerController::class, 'deleteTemplate']
    );
});
