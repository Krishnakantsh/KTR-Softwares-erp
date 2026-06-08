<?php

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\ClassMasterController;
use App\Http\Controllers\ClassSectionController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConcessionByController;
use App\Http\Controllers\ConcessionTypeController;
use App\Http\Controllers\DocumentCategoryController;
use App\Http\Controllers\DocumentTemplateController;
use App\Http\Controllers\Hostel_System\HostelBlockController;
use App\Http\Controllers\Hostel_System\HostelController;
use App\Http\Controllers\Hostel_System\HostelFloorController;
use App\Http\Controllers\Hostel_System\RoomMasterController;
use App\Http\Controllers\Hostel_System\RoomTypeController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\SubjectGroupController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SmsTemplateController;
use App\Http\Controllers\SmsTemplateTypeController;
use App\Http\Controllers\StreamMasterController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectLinkController;
use App\Http\Controllers\Transport\TransportAssignVehicleController;
use App\Http\Controllers\Transport\TransportDestinationController;
use App\Http\Controllers\Transport\TransportRouteController;
use App\Http\Controllers\Transport\TransportVehicleController;
use App\Http\Controllers\TransportMonthController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->middleware(['auth'])->group(function () {

    // for admin route methods

    Route::get('test', function () {
        return view('Frontend/Normal/Pages/document_generate/build_document');
        // return view('Frontend/Normal/Pages/Student/id_card_generate');
    })->name('test');

    Route::prefix('v1')->group(function () {

        Route::prefix('school')->name('school.')->group(function () {

            Route::controller(SchoolController::class)->group(function () {
                Route::get('index', 'index')->name('update.details');
                Route::post('save-school', 'saveSchool')->name('save.details');
                Route::get('setting', 'getSetting')->name('setting');
            });

            Route::controller(AcademicSessionController::class)->group(function () {
                Route::get('fetch', 'fetch')->name('sessions.fetch');
                Route::post('save', 'store')->name('sessions.save');
                Route::post('change', 'change')->name('sessions.change');
            });

            Route::controller(ClassMasterController::class)->prefix('class-master')
                ->name('class.master.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/get-all', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::post('/save', 'save')->name('save');
                    Route::get('/get', 'show')->name('get');
                    Route::delete('/delete', 'destroy')->name('delete');
                });

            Route::controller(StreamMasterController::class)->prefix('stream-master')
                ->name('stream.master.')->group(function () {
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

            Route::controller(ClassSectionController::class)->prefix('class-section')
                ->name('class.section.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/get-all', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::post('/save', 'store')->name('save');
                    Route::get('/get', 'show')->name('get');
                    Route::delete('/delete', 'destroy')->name('delete');
                });

            Route::controller(SubjectGroupController::class)->prefix('subject-group')
                ->name('subject.group.')->group(function () {
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

            Route::controller(SubjectController::class)->prefix('subject')
                ->name('subject.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(SubjectLinkController::class)->prefix('subject-link')
                ->name('subject.link.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });


            Route::controller(TransportVehicleController::class)->prefix('transport-vehicle')
                ->name('transport.vehicle.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });




            Route::controller(TransportRouteController::class)->prefix('transport-route')
                ->name('transport.route.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });



            Route::controller(TransportDestinationController::class)->prefix('transport-destination')
                ->name('transport.destination.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });



            Route::controller(TransportAssignVehicleController::class)->prefix('transport-asign-vehicle')
                ->name('transport.assign.vehicle.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });




            Route::controller(HostelController::class)->prefix('hostel')
                ->name('hostel.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(HostelBlockController::class)->prefix('hostel-block')
                ->name('hostel.block.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(HostelFloorController::class)->prefix('hostel-floor')
                ->name('hostel.floor.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(RoomTypeController::class)->prefix('room-type')
                ->name('room.type.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(RoomMasterController::class)->prefix('room-master')
                ->name('room.master.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });


            Route::controller(HouseController::class)->prefix('house')
                ->name('house.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });


            Route::controller(ConcessionByController::class)->prefix('concession-by')
                ->name('concession.by.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(ConcessionTypeController::class)->prefix('concession-type')
                ->name('concession.type.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });


            Route::controller(SmsTemplateTypeController::class)->prefix('sms-template-type')
                ->name('template.type.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });


            Route::controller(SmsTemplateController::class)->prefix('sms-template')
                ->name('template.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(TransportMonthController::class)->prefix('transport-month')
                ->name('transport_month.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                    Route::get('/show-with', 'showWith')->name('get.with');
                    Route::put('/status', 'status')->name('status');
                    Route::put('/is-enabled', 'is_enabled')->name('is_enabled');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(DocumentCategoryController::class)->prefix('document-category')
                ->name('document.category.')->group(function () {
                    Route::get('/fetch', 'fetch')->name('fetch');
                    Route::put('/status', 'status')->name('status');
                    Route::get('/show', 'show')->name('get');
                    Route::post('/store', 'store')->name('save');
                    Route::delete('/delete', 'destroy')->name('delete');
                    Route::get('/trash', 'trash')->name('trash');
                    Route::post('/restore', 'restore')->name('restore');
                    Route::delete('/force-delete', 'forceDelete')->name('force.delete');
                });

            Route::controller(DocumentTemplateController::class)->prefix('document-template')
                ->name('document.template.')->group(function () {
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

            //  for promoted students 

            Route::controller(StudentController::class)->prefix('transport-month')
                ->name('transport_month.')->group(function () {});



            // common routes

            Route::controller(CommonController::class)->prefix('common-tasks')
                ->name('common.')->group(function () {
                    Route::get('/generate-student-sr-no', 'generateSrNo')->name('generate_sr_no');
                    Route::get('/generate-student-adm-no', 'generateAdmissionNo')->name('generate_admission_no');
                    Route::get('/generate-student-enroll-no', 'generateEnrollmentNo')->name('generate_enrollment_no');
                    Route::get('/get-class-devisions-by-class-id', 'getClassDevisionsByClassId')->name('get_class_devisions_by_class_id');
                    Route::get('/get-destinations-by-route-id', 'getDestinationsByRouteId')->name('get_destinations_by_route_id');
                    Route::get('/get-vehicles-by-route-id', 'getVehiclesByRouteId')->name('get_vehicles_by_route_id');
                    Route::get('/get-floors-by-block-id', 'getFloorsByBlockId')->name('get_floors_by_block_id');
                    Route::get('/get-blocks-by-hostel-id', 'getBlocksByHostelId')->name('get_blocks_by_hostel_id');

                    Route::get('/get-rooms-by-floor-id', 'getRoomsByFloorId')->name('get_rooms_by_floor_id');
                    Route::get('/search-student', 'searchList')->name('search_student');

                    Route::post('/assign-rollno-exam-rollno', 'assignRollNoExamRollNo')->name('save_assign_roll_no');
                    Route::get('/get-students-based-class-section', 'getStudentsBasedClassSection')->name('get_students_based_class_section');
                });
        });
    });
});
