<?php

use App\Http\Controllers\School\UserSetting\UserSettingMasterController;
use App\Http\Controllers\School\UserSetting\UserSettingValueController;
use App\Http\Controllers\SuperAdmin\Broadcast\BroadcastController;
use App\Http\Controllers\SuperAdmin\Modules\ModulesMasterController;
use App\Http\Controllers\SuperAdmin\Modules\SchoolModuleSettingController;
use App\Http\Controllers\SuperAdmin\Notification\NotificationTemplateController;
use App\Http\Controllers\SuperAdmin\SubModules\SchoolSubModuleSettingController;
use App\Http\Controllers\SuperAdmin\SubModules\SubModulesMasterController;
use App\Http\Controllers\SuperAdmin\SubscriptionPlan\PlanFeatureController;
use App\Http\Controllers\SuperAdmin\SubscriptionPlan\PlanFeatureMappingController;
use App\Http\Controllers\SuperAdmin\SubscriptionPlan\SubscriptionPlanController;
use App\Http\Controllers\SuperAdmin\SubscriptionPlan\TenantSubscriptionController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {

    // for admin route methods

    Route::prefix('v1')->group(function () {

        Route::prefix('super-admin')->middleware(['auth:super_admin'])->name('superAdmin.')->group(function () {

            Route::controller(SuperAdminController::class)->group(function () {

                Route::get('/', 'dashboard')->name('dashboard');

                Route::prefix('school')->name('school.')->group(function () {
                    Route::get('/register-view', 'registerManageView')->name('register.manageView');
                    Route::get('/complete-school-process', 'completeSchoolProcess')->name('completeSchoolProcess');

                    Route::get('/all-schools', 'allSchools')->name('allSchools');
                    Route::post('/register', 'register')->name('register');

                    Route::post('/toggle-status', 'toggleStatus')->name('toggleStatus');
                    Route::post('/make-school-profile', 'makeSchoolProfile')->name('makeSchoolProfile');
                    Route::post('/createDatabaseAndCloned', 'createDatabaseAndCloned')->name('createDatabaseAndCloned');
                    Route::get('/show', 'show')->name('show');
                    Route::get('/plan-changing', 'planChanging')->name('planChanging');
                    Route::get('/fetch-all-schools', 'fetchAllSchools')->name('fetchAllSchools');
                    Route::get('/fetch-all-tenants', 'fetchAllTenants')->name('fetchAllTenants');
                    Route::get('/get-subscription-data', 'getSubscriptionData')->name('getSubscriptionData');
                });

                Route::name('subscriptionPlan.')->group(function () {
                    Route::get('/subscription-plan', 'manageSubscriptionPlan')->name('manageView');
                });

                Route::get('/subscription-plan-features', 'managePlanFeatures')->name('planFeature.manageView');
                Route::get('/subscription-plan-features-mapping', 'planFeaturesMapping')->name('planFeaturesMapping.manageView');
            });

            Route::get('/tenant/lease-management-data', [TenantSubscriptionController::class, 'getLeaseManagementData'])->name('tenant.getLeaseManagementData');
            Route::post('/tenant/process-lease-change', [TenantSubscriptionController::class, 'processLeaseChange'])->name('tenant.processLeaseChange');


            Route::controller(SubscriptionPlanController::class)->prefix('subscription-plan')->name('subscriptionPlan.')->group(function () {
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
                Route::post('/mapping', 'mapping')->name('mapping');
                Route::delete('/force-delete', 'forceDelete')->name('force.delete');
            });

            Route::controller(PlanFeatureMappingController::class)->prefix('plan-feature-mapping')->name('planFeaturesMapping.')->group(function () {
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
                Route::post('/mapping', 'mapping')->name('mapping');

                Route::delete('/force-delete', 'forceDelete')->name('force.delete');
            });

            Route::controller(PlanFeatureController::class)->prefix('subscription-plan-features')->name('planFeature.')->group(function () {
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

            Route::controller(BroadcastController::class)->prefix('broadcast')->name('broadcast.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/list', 'list')->name('list');
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
            Route::controller(BroadcastController::class)->prefix('broadcast-analysis')->name('broadcast.analysis.')->group(function () {
                Route::get('/index', 'index')->name('index');
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
                Route::post('/broadcasts/{uuid}/action', 'trackAction')->name('trackAction');
            });
            Route::controller(NotificationTemplateController::class)->prefix('notification-template')->name('notificationTemplate.')->group(function () {
                Route::get('/index', 'index')->name('index');
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
                Route::post('/bulk-upload', 'bulkJsonUpload')->name('bulkUpload');
            });
            Route::controller(ModulesMasterController::class)->prefix('moduleMaster')->name('moduleMaster.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(SchoolModuleSettingController::class)->prefix('moduleMasterMapping')->name('moduleMasterMapping.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::delete('/mapping', 'mapping')->name('mapping');
                Route::get('/get-module-mapping', 'ModuleMapping')->name('getModuleMapping');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(SubModulesMasterController::class)->prefix('sub-module-master')->name('subModuleMaster.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::get('/by-module', 'byModule')->name('byModule');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
            });

            Route::controller(SchoolSubModuleSettingController::class)->prefix('sub-module-master-mapping')->name('subModuleMasterMapping.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::delete('/mapping', 'mapping')->name('mapping');
                Route::get('/get-sub-module-mapping', 'SubModuleMapping')->name('subModuleMapping');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(UserSettingMasterController::class)->prefix('user-setting-master')->name('userSettingMaster.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::delete('/mapping', 'mapping')->name('mapping');
                Route::get('/get-sub-module-mapping', 'SubModuleMapping')->name('subModuleMapping');
                Route::delete('/delete', 'destroy')->name('delete');
            });
            Route::controller(UserSettingValueController::class)->prefix('user-setting-value')->name('userSettingValue.')->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/fetch', 'fetch')->name('fetch');
                Route::get('/fetch-with', 'fetchWith')->name('fetch.with');
                Route::get('/show-with', 'showWith')->name('get.with');
                Route::put('/status', 'status')->name('status');
                Route::get('/show', 'show')->name('get');
                Route::post('/store', 'store')->name('save');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::delete('/mapping', 'mapping')->name('mapping');
                Route::get('/get-sub-module-mapping', 'SubModuleMapping')->name('subModuleMapping');
                Route::delete('/delete', 'destroy')->name('delete');
                Route::get('/fetchWithSchool', 'fetchWithSchool')->name('fetchWithSchool');
            });
        });
    });
});
