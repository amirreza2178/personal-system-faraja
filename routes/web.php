<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveBalanceController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\DashboardController;
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


Route::GET('/logout', [AuthController::class, 'logout'])
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

 Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');


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

     Route::get('/employees-trash', [EmployeeController::class, 'trash'])
        ->name('employees.trash');

    Route::patch('/employees/{employee}/restore', [EmployeeController::class, 'restore'])
        ->name('employees.restore');

    Route::delete('/employees/{employee}/force-delete', [EmployeeController::class, 'forceDelete'])
        ->name('employees.force-delete');

    Route::resource('employees', EmployeeController::class);

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

// Faraja@1405




// @extends('layouts.app')

// @section('content')

// <div class="container-fluid py-4">

//     {{-- Header --}}
//     <div class="d-flex justify-content-between align-items-center mb-4">
//         <div>
//             <h2 class="fw-bold mb-1">داشبورد سیستم پرسنلی</h2>
//             <p class="text-muted mb-0">
//                 نمای کلی وضعیت کارکنان، حضور و غیاب و مرخصی‌ها
//             </p>
//         </div>
//     </div>

//     {{-- Statistics --}}
//     <div class="row g-4 mb-4">

//         <div class="col-md-3">
//             <div class="card border-0 shadow-sm h-100">
//                 <div class="card-body">
//                     <div class="text-muted mb-2">کل کارکنان</div>
//                     <h2 class="fw-bold mb-0">{{ $employeesCount }}</h2>
//                 </div>
//             </div>
//         </div>

//         <div class="col-md-3">
//             <div class="card border-0 shadow-sm h-100">
//                 <div class="card-body">
//                     <div class="text-muted mb-2">حضور و غیاب</div>
//                     <h2 class="fw-bold mb-0">{{ $attendancesCount }}</h2>
//                 </div>
//             </div>
//         </div>

//         <div class="col-md-3">
//             <div class="card border-0 shadow-sm h-100">
//                 <div class="card-body">
//                     <div class="text-muted mb-2">درخواست‌های مرخصی</div>
//                     <h2 class="fw-bold mb-0">{{ $leaveRequestsCount }}</h2>
//                 </div>
//             </div>
//         </div>

//         <div class="col-md-3">
//             <div class="card border-0 shadow-sm h-100">
//                 <div class="card-body">
//                     <div class="text-muted mb-2">در انتظار تأیید</div>
//                     <h2 class="fw-bold mb-0">{{ $pendingLeaveRequestsCount }}</h2>
//                 </div>
//             </div>
//         </div>

//     </div>

//     {{-- Quick Access --}}
//     <div class="card border-0 shadow-sm">
//         <div class="card-body">

//             <h5 class="fw-bold mb-4">دسترسی سریع</h5>

//             <div class="row g-3">

//                 <div class="col-md-4">
//                     <a href="{{ route('employees.index') }}"
//                        class="btn btn-outline-primary w-100 py-3">
//                         👥 مدیریت کارکنان
//                     </a>
//                 </div>

//                 <div class="col-md-4">
//                     <a href="{{ route('attendances.index') }}"
//                        class="btn btn-outline-success w-100 py-3">
//                         🕐 حضور و غیاب
//                     </a>
//                 </div>

//                 <div class="col-md-4">
//                     <a href="{{ route('leave-requests.index') }}"
//                        class="btn btn-outline-warning w-100 py-3">
//                         📋 مدیریت مرخصی‌ها
//                     </a>
//                 </div>

//             </div>

//         </div>
//     </div>

// </div>

// @endsection