<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveBalanceController;
use App\Http\Controllers\LeaveRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Application Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Departments
    |--------------------------------------------------------------------------
    */

    Route::resource('departments', DepartmentController::class);


    /*
    |--------------------------------------------------------------------------
    | Employees
    |--------------------------------------------------------------------------
    */

    Route::resource('employees', EmployeeController::class);

    Route::get('/employees-trash', [EmployeeController::class, 'trash'])
        ->name('employees.trash');

    Route::patch('/employees/{employee}/restore', [EmployeeController::class, 'restore'])
        ->name('employees.restore');

    Route::delete('/employees/{employee}/force-delete', [EmployeeController::class, 'forceDelete'])
        ->name('employees.force-delete');


    /*
    |--------------------------------------------------------------------------
    | Employee Leave Balance
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/employees/{employee}/leave-balance',
        [LeaveBalanceController::class, 'show']
    )->name('employees.leave-balance');

    Route::put(
        '/employees/{employee}/leave-balance',
        [LeaveBalanceController::class, 'update']
    )->name('employees.leave-balance.update');


    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */

    Route::resource('attendances', AttendanceController::class);


    /*
    |--------------------------------------------------------------------------
    | Leave Requests
    |--------------------------------------------------------------------------
    */

    Route::prefix('leave-requests')
        ->name('leave-requests.')
        ->group(function () {

            Route::get('/', [LeaveRequestController::class, 'index'])
                ->name('index');

            Route::get('/create', [LeaveRequestController::class, 'create'])
                ->name('create');

            Route::post('/', [LeaveRequestController::class, 'store'])
                ->name('store');

            Route::get('/{leaveRequest}', [LeaveRequestController::class, 'show'])
                ->name('show');

            Route::get('/{leaveRequest}/edit', [LeaveRequestController::class, 'edit'])
                ->name('edit');

            Route::put('/{leaveRequest}', [LeaveRequestController::class, 'update'])
                ->name('update');

            Route::delete('/{leaveRequest}', [LeaveRequestController::class, 'destroy'])
                ->name('destroy');

            Route::post('/{leaveRequest}/approve', [LeaveRequestController::class, 'approve'])
                ->name('approve');

            Route::post('/{leaveRequest}/reject', [LeaveRequestController::class, 'reject'])
                ->name('reject');

            Route::patch('/{leaveRequest}/cancel', [LeaveRequestController::class, 'cancel'])
                ->name('cancel');
        });
});