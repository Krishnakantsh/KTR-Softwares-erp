<?php

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\Calendar\CalendarEventController;
use App\Http\Controllers\Calendar\CalendarEventRecurrenceController;
use App\Http\Controllers\Calendar\CalendarEventTypeController;
use App\Http\Controllers\Calendar\CalendarWeeklyOffController;
use App\Http\Controllers\ClassMasterController;
use App\Http\Controllers\ClassSectionController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Complaints\ComplaintController;
use App\Http\Controllers\complaints\ComplaintMessageController;
use App\Http\Controllers\Complaints\ComplaintTypeController;
use App\Http\Controllers\ConcessionByController;
use App\Http\Controllers\ConcessionTypeController;
use App\Http\Controllers\DocumentCategoryController;
use App\Http\Controllers\DocumentTemplateController;
use App\Http\Controllers\FeeModule\FeeCollectionController;
use App\Http\Controllers\FeeModule\FeeFineMasterController;
use App\Http\Controllers\FeeModule\FeeGroupController;
use App\Http\Controllers\FeeModule\FeeHeadApplicabilityController;
use App\Http\Controllers\FeeModule\FeeHeadController;
use App\Http\Controllers\FeeModule\FeeInstallmentMasterController;
use App\Http\Controllers\FeeModule\FeeStructureController;
use App\Http\Controllers\FeeModule\StudentFeeAssignmentController;
use App\Http\Controllers\FeeModule\StudentFeeConcessionController;
use App\Http\Controllers\Hostel_System\HostelBlockController;
use App\Http\Controllers\Hostel_System\HostelController;
use App\Http\Controllers\Hostel_System\HostelFloorController;
use App\Http\Controllers\Hostel_System\RoomMasterController;
use App\Http\Controllers\Hostel_System\RoomTypeController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\Payroll\AllowanceController;
use App\Http\Controllers\Payroll\BranchController;
use App\Http\Controllers\Payroll\DepartmentController;
use App\Http\Controllers\Payroll\DesignationController;
use App\Http\Controllers\Payroll\EmployeeAttendanceController;
use App\Http\Controllers\Payroll\EmployeeController;
use App\Http\Controllers\Payroll\EmployeeGeneralInformationController;
use App\Http\Controllers\Payroll\EmploymentController;
use App\Http\Controllers\Payroll\EmploymentTypeController;
use App\Http\Controllers\Payroll\ShiftController;
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


Route::get('testing1', function () {
    return view('Helpers.testing');
})->name('testing1');


Route::prefix('auth')->middleware(['auth'])->group(function () {

    // for admin route methods

    Route::get('test', function () {
        return "Testing....";
    })->name('test');


    Route::prefix('v1')->group(function () {

        Route::prefix('school')->name('school.')->group(function () {

            Route::controller(SchoolController::class)->group(function () {
                Route::get('index', 'index')->name('update.details');
                Route::post('save-school', 'saveSchool')->name('save.details');
                Route::get('setting', 'getSetting')->name('setting');
                Route::get('get', 'get')->name('get');
                Route::post('sessionSetupForSchool', 'sessionSetupForSchool')->name('sessionSetupForSchool');
                Route::get('update-month-order-setting', 'updateMonthOrderAndSetting')->name('updateMonthOrderAndSetting');
                Route::post('session-month-reorder', 'sessionMonthReorder')->name('sessionMonth.reorder');
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



            Route::controller(StudentController::class)->prefix('student')
                ->name('student.')->group(function () {
                    Route::get('/get-student-for-promotion-and-demotion', 'getStudentsForPromotionAndDemotion')->name('getStudentsForPromotionAndDemotion');
                    Route::post('/process-promotion-and-demotion', 'promoteAndDemoteStudents')->name('promoteAndDemoteStudents');
                });

            Route::controller(CommonController::class)->prefix('common-tasks')
                ->name('common.')->group(function () {
                    Route::get('/generate-student-sr-no', 'generateSrNo')->name('generate_sr_no');
                    Route::get('/generate-student-adm-no', 'generateAdmissionNo')->name('generate_admission_no');
                    Route::get('/get-class-devisions-by-class-id', 'getClassDevisionsByClassId')->name('get_class_devisions_by_class_id');
                    Route::get('/generate-student-enroll-no', 'generateEnrollmentNo')->name('generate_enrollment_no');
                    Route::get('/generate-library-membership-number', 'generateLibraryMembershipNumber')->name('generate_library_membership_number');
                    Route::get('/get-destinations-by-route-id', 'getDestinationsByRouteId')->name('get_destinations_by_route_id');
                    Route::get('/get-vehicles-by-route-id', 'getVehiclesByRouteId')->name('get_vehicles_by_route_id');
                    Route::get('/get-floors-by-block-id', 'getFloorsByBlockId')->name('get_floors_by_block_id');
                    Route::get('/get-blocks-by-hostel-id', 'getBlocksByHostelId')->name('get_blocks_by_hostel_id');

                    Route::get('/get-rooms-by-floor-id', 'getRoomsByFloorId')->name('get_rooms_by_floor_id');
                    Route::get('/search-student', 'searchList')->name('search_student');

                    Route::post('/assign-rollno-exam-rollno', 'assignRollNoExamRollNo')->name('save_assign_roll_no');
                    Route::get('/get-library-member-with-book-histrory', 'getLibraryMemberWithBooksHistrory')->name('getLibraryMemberWithBooksHistrory');
                    Route::get('/get-students-based-class-section', 'getStudentsBasedClassSection')->name('get_students_based_class_section');
                });




            Route::controller(FeeGroupController::class)->prefix('fee-group')->name('feeGroup.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            // Fee Module routes 

            Route::controller(FeeHeadController::class)->prefix('fee-head')->name('feeHead.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(FeeHeadApplicabilityController::class)->prefix('fee-head-availability')->name('feeHeadApplicability.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::get('/getByHead', 'getByHead')->name('getByHead');
            });
            Route::controller(FeeInstallmentMasterController::class)->prefix('fee-installment')->name('feeInstallment.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::get('/getByHead', 'getByHead')->name('getByHead');
            });
            Route::controller(FeeStructureController::class)->prefix('fee-structure')->name('feeStructure.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::get('/getByHead', 'getByHead')->name('getByHead');
                Route::get('/matrix', 'getMatrix')->name('matrix');
            });
            Route::prefix('fee-assignment')->name('studentFeeAssignment.')->group(function () {

                Route::get('/', [StudentFeeAssignmentController::class, 'index'])->name('index');

                // NEW - needed by the frontend to know whether the selected student
                // already has an assignment for the active session, and to load it.
                Route::get('/by-student', [StudentFeeAssignmentController::class, 'byStudent'])->name('byStudent');

                Route::get('/show/{id}', [StudentFeeAssignmentController::class, 'show'])->name('show');

                Route::post('/assign', [StudentFeeAssignmentController::class, 'assign'])->name('assign');
                Route::post('/re-assign', [StudentFeeAssignmentController::class, 'reAssign'])->name('reAssign');
                Route::post('/update-amount', [StudentFeeAssignmentController::class, 'updateAmount'])->name('updateAmount');
                Route::post('/remove-head', [StudentFeeAssignmentController::class, 'removeHead'])->name('removeHead');
                Route::delete('/destroy', [StudentFeeAssignmentController::class, 'destroy'])->name('destroy');
            });
            Route::controller(FeeFineMasterController::class)->prefix('fee-fine-master')->name('feeFineMaster.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::get('/getByHead', 'getByHead')->name('getByHead');
                Route::get('/matrix', 'getMatrix')->name('matrix');
            });
            Route::controller(StudentFeeConcessionController::class)->prefix('fee-concession')->name('feeConcession.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::get('/fetch-assignment-details', 'fetchAssignmentDetails')->name('assignmentDetails');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(FeeCollectionController::class)->prefix('fee-collection')->name('feeCollection.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::get('/getByHead', 'getByHead')->name('getByHead');
                Route::get('/matrix', 'getMatrix')->name('matrix');
                Route::get('/ledger-by-student', 'ledgerByStudent')->name('byStudent');
                Route::get('/generate-fee-receipt-no', 'generateReceiptNo')->name('generateReceiptNo');
                Route::get('/fee-collection-history', 'historyByStudent')->name('history');
            });


            // complaint module routes

            Route::controller(ComplaintTypeController::class)->prefix('complaint-type')->name('complaintType.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(ComplaintController::class)->prefix('complaint')->name('complaint.')->group(function () {
                Route::get('/comlaint-dashboard', 'dashboard')->name('dashboard');
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'updateStatus')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(ComplaintMessageController::class)->prefix('complaint-message')->name('complaintMessage.')->group(function () {
                Route::get('/comlaint-dashboard', 'dashboard')->name('dashboard');
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });


            // calender module routes 

            Route::controller(CalendarEventTypeController::class)->prefix('calendar-event-type')->name('calendarEventType.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(CalendarEventController::class)->prefix('calendar-event')->name('calendarEvent.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::get('/events-by-month', 'eventsByMonth')->name('events-by-month');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(CalendarEventRecurrenceController::class)->prefix('calender-event-recurrence')->name('calenderEventRecurrence.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(CalendarWeeklyOffController::class)->prefix('calender-weekly-off')->name('calendarWeeklyOff.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            // payroll routes start 

            Route::controller(EmployeeController::class)->prefix('payroll-employee')->name('payroll_employee.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(BranchController::class)->prefix('payroll-branch')->name('payroll_branch.')->group(function () {
                Route::get('/get-departments', 'getDepartments')->name('get_departments');
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(DepartmentController::class)->prefix('payroll-department')->name('payroll_department.')->group(function () {
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


            Route::controller(DesignationController::class)->prefix('payroll-designation')->name('payroll_designation.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(AllowanceController::class)->prefix('payroll-allowance')->name('payroll_allowance.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(EmploymentTypeController::class)->prefix('payroll-employment-type')->name('payroll_employment_type.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(ShiftController::class)->prefix('payroll-shift')->name('payroll_shift.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });


            Route::controller(EmployeeGeneralInformationController::class)->prefix('employee-general-info')->name('employee_general_info.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(EmploymentController::class)->prefix('employee-employee-employment-details')->name('payroll_employee_employment.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(EmployeeAttendanceController::class)->prefix('employee-attendance')->name('employee_attendance.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/registered-fetch', 'registered_fetch')->name('registered_fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show-attendant-staff', 'showAttendantStaff')->name('showAttendantStaff');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
        });
    });
});
