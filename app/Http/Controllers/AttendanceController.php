<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    /**
     * نمایش لیست حضور و غیاب
     */
    public function index(Request $request)
    {
        $query = Attendance::with('employee');

        /*
        |--------------------------------------------------------------------------
        | Employee Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('employee_id')) {

            $query->where(
                'employee_id',
                $request->employee_id
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Date
        |--------------------------------------------------------------------------
        */

        if ($request->filled('attendance_date')) {

            $query->where(
                'attendance_date',
                $request->attendance_date
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Date From
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {

            $query->whereDate(
                'attendance_date',
                '>=',
                $request->date_from
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Date To
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_to')) {

            $query->whereDate(
                'attendance_date',
                '<=',
                $request->date_to
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $attendancesCount = Attendance::count();

        $presentCount = Attendance::where(
            'status',
            'present'
        )->count();

        $absentCount = Attendance::where(
            'status',
            'absent'
        )->count();

        $lateCount = Attendance::where(
            'status',
            'late'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Paginated Results
        |--------------------------------------------------------------------------
        */

        $attendances = $query
            ->latest('attendance_date')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Employees
        |--------------------------------------------------------------------------
        */

        $employees = Employee::orderBy(
            'first_name'
        )->orderBy(
            'last_name'
        )->get();

        return view(
            'attendances.index',
            compact(
                'attendances',
                'employees',
                'attendancesCount',
                'presentCount',
                'absentCount',
                'lateCount'
            )
        );
    }

    /**
     * فرم ثبت حضور و غیاب
     */
    public function create()
    {
        $employees = Employee::orderBy(
            'first_name'
        )->orderBy(
            'last_name'
        )->get();

        return view(
            'attendances.create',
            compact('employees')
        );
    }

    /**
     * ذخیره حضور و غیاب
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'employee_id' => [
                'required',
                'exists:employees,id',
            ],

            'attendance_date' => [
                'required',
                'date',
            ],

            'check_in' => [
                'nullable',
                'date_format:H:i',
            ],

            'check_out' => [
                'nullable',
                'date_format:H:i',
            ],

            'status' => [
                'required',
                Rule::in([
                    'present',
                    'absent',
                    'late',
                    'leave',
                    'mission',
                    'holiday',
                ]),
            ],

            'description' => [
                'nullable',
                'string',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Duplicate Protection
        |--------------------------------------------------------------------------
        */

        $exists = Attendance::where(
            'employee_id',
            $validated['employee_id']
        )
            ->where(
                'attendance_date',
                $validated['attendance_date']
            )
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'برای این پرسنل در این تاریخ، رکورد حضور و غیاب قبلاً ثبت شده است.'
                );

        }

        /*
        |--------------------------------------------------------------------------
        | Create
        |--------------------------------------------------------------------------
        */

        Attendance::create(
            $validated
        );

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'رکورد حضور و غیاب با موفقیت ثبت شد.'
            );
    }

    /**
     * نمایش جزئیات
     */
    public function show(
        Attendance $attendance
    ) {
        $attendance->load(
            'employee.department'
        );

        return view(
            'attendances.show',
            compact('attendance')
        );
    }

    /**
     * فرم ویرایش
     */
    public function edit(
        Attendance $attendance
    ) {
        $employees = Employee::orderBy(
            'first_name'
        )->orderBy(
            'last_name'
        )->get();

        return view(
            'attendances.edit',
            compact(
                'attendance',
                'employees'
            )
        );
    }

    /**
     * بروزرسانی
     */
    public function update(
        Request $request,
        Attendance $attendance
    ) {
        $validated = $request->validate([

            'employee_id' => [
                'required',
                'exists:employees,id',
            ],

            'attendance_date' => [
                'required',
                'date',
            ],

            'check_in' => [
                'nullable',
                'date_format:H:i',
            ],

            'check_out' => [
                'nullable',
                'date_format:H:i',
            ],

            'status' => [
                'required',
                Rule::in([
                    'present',
                    'absent',
                    'late',
                    'leave',
                    'mission',
                    'holiday',
                ]),
            ],

            'description' => [
                'nullable',
                'string',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Duplicate Protection During Update
        |--------------------------------------------------------------------------
        */

        $exists = Attendance::where(
            'employee_id',
            $validated['employee_id']
        )
            ->where(
                'attendance_date',
                $validated['attendance_date']
            )
            ->where(
                'id',
                '!=',
                $attendance->id
            )
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'برای این پرسنل در این تاریخ، رکورد دیگری قبلاً ثبت شده است.'
                );

        }

        $attendance->update(
            $validated
        );

        return redirect()
            ->route(
                'attendances.show',
                $attendance
            )
            ->with(
                'success',
                'رکورد حضور و غیاب با موفقیت بروزرسانی شد.'
            );
    }

    /**
     * حذف رکورد
     */
    public function destroy(
        Attendance $attendance
    ) {
        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'رکورد حضور و غیاب با موفقیت حذف شد.'
            );
    }
}
