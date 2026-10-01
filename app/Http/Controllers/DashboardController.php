<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'employeesCount' => Employee::query()->count(),

            'attendancesCount' => Attendance::query()->count(),

            'leaveRequestsCount' => LeaveRequest::query()->count(),

            'pendingLeaveRequestsCount' => LeaveRequest::query()
                ->where('status', 'pending')
                ->count(),
        ]);
    }
}