<?php

use App\Http\Controllers\SchoolPageController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware(['auth'])->group(function () {



    Route::prefix('v1')->group(function () {

        Route::prefix('school')->name('school.')->group(function () {

            Route::controller(SchoolPageController::class)->name('student.')->group(function () {
                Route::get('student-portfolio', 'studentPortFolio')->name('portfolio');
                Route::get('view-tc-bc-cc-formats', 'addTcBcAndCCFormat')->name('viewTcBcAndCc');
                Route::get('promote-and-demote-student-view', 'promoteAndDemoteStudentsView')->name('promoteAndDemoteStudentsView');
                Route::get('add-and-update-study-material', 'addAndUpdateStudyMaterialView')->name('addAndUpdateStudyMaterial');
                Route::get('add-and-update-homework', 'addAndUpdateHomeworkView')->name('addAndUpdateHomework');
                Route::get('add-and-update-previous-year-papers', 'addAndUpdatePreviousYearPapers')->name('addAndUpdatePreviousYearPapers');
            });
        });
    });
});
