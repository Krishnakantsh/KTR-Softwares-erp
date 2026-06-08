<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TotalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Frontend/Authentication/login');
});


Route::get('forgot-password-latest', [Authentication::class, 'forgot_password'])->name('password.forgot');
Route::get('reset-password-latest', [Authentication::class, 'reset_password'])->name('password.reset');


Route::prefix('auth')->middleware(['auth'])->group(function () {

    // for admin route methods

    Route::prefix('v1')->group(function () {
        Route::prefix('admin')->group(function () {

            Route::controller(AdminController::class)->group(function () {
                Route::get('dashboard', 'dashboard')->name('dashboard');
                Route::get('roles-page', 'roles_page')->name('manage_roles');
                Route::get('subscription-plans', 'our_plans')->name('our_plans');
                Route::get('search-users', 'search_users')->name('search.users');
                Route::get('get-roles', 'getRoles')->name('getRoles');
            });


            Route::prefix('total')->name('total.')->controller(TotalController::class)->group(function () {
                Route::post('store', 'store')->name('add_total_test');
                Route::get('index', 'index')->name('get_total_test');
                Route::get('testingPage', 'testingPage')->name('testingPage');
            });

            Route::controller(RoleController::class)->group(function () {
                Route::get('aassign-role-to-model', 'assignRoleToModel')->name('assignRoleToModel');
                Route::post('assign-role', 'assignRole')->name('assignRole');
                Route::post('add-role', 'add_role')->name('add_role');
                Route::get('get-role-with-permissions', 'getRoleWithPermissions')->name('getRoleWithPermissions');
                Route::get('/search-roles', 'searchRoles')->name('search.roles');
                Route::get('get-role-by-id', 'getRoleById')->name('getRoleById');
                Route::get('get-role', 'get_roles')->name('get_roles');
                Route::delete('delete-role', 'delete_role')->name('delete_role');
            });
            Route::controller(PermissionController::class)->group(function () {
                Route::get('/permission', 'index')->name('manage_permissions');
                Route::get('/permission-assign', 'assign_permission_view')->name('assign_permission.view');
                Route::post('/permission-assign', 'assign_permission')->name('assign_permission');
                Route::post('permission/add', 'add_permission')->name('addPermissions');
                Route::get('permission/get-by-id', 'get_permission_by_id')->name('getpermissionById');
                Route::get('permissions/all', 'get_permissions')->name('get_permissions');
                Route::delete('permissions/delete', 'delete_permission')->name('delete_permission');
            });
        });
       
    });
});

Route::get('get-session', [TotalController::class, 'session_check']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
