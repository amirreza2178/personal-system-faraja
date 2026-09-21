<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveRequest;

class DashboardController extends Controller
{
    /**
     * نمایش داشبورد اصلی سیستم.
     */
    public function index()
    {
        $employeesCount = Employee::count();

        $attendancesCount = Attendance::count();

        $leaveRequestsCount = LeaveRequest::count();

        $pendingLeaveRequestsCount = LeaveRequest::pending()->count();

        return view('dashboard', compact(
            'employeesCount',
            'attendancesCount',
            'leaveRequestsCount',
            'pendingLeaveRequestsCount'
        ));
    }
}










