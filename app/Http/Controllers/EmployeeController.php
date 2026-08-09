<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();

        return view('employee.index', compact('employees'));
    }
}