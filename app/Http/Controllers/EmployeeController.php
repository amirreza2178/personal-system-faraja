<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\LeaveBalanceService;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Enums\LeaveType;
use App\Enums\LeaveStatus;

class EmployeeController extends Controller
{
    /**
     * نمایش لیست پرسنل
     */
    public function index(Request $request)
    {
        $query = Employee::with('department');

        /*
        |--------------------------------------------------------------------------
        | نام
        |--------------------------------------------------------------------------
        */
        if ($request->filled('first_name')) {
            $query->where(
                'first_name',
                'like',
                '%' . trim($request->first_name) . '%'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | نام خانوادگی
        |--------------------------------------------------------------------------
        */
        if ($request->filled('last_name')) {
            $query->where(
                'last_name',
                'like',
                '%' . trim($request->last_name) . '%'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | درجه
        |--------------------------------------------------------------------------
        */
        if ($request->filled('rank')) {
            $query->where(
                'rank',
                'like',
                '%' . trim($request->rank) . '%'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | واحد سازمانی
        |--------------------------------------------------------------------------
        */
        if ($request->filled('department_id')) {
            $query->where(
                'department_id',
                $request->department_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | مقطع تحصیلی
        |--------------------------------------------------------------------------
        */
        if ($request->filled('education_level')) {
            $query->where(
                'education_level',
                $request->education_level
            );
        }

        /*
        |--------------------------------------------------------------------------
        | وضعیت پرسنل
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
        | Pagination
        |--------------------------------------------------------------------------
        */
        $employees = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | آمار کلی
        |--------------------------------------------------------------------------
        */
        $employeesCount = Employee::count();

        $departmentsCount = Department::count();

        /*
        |--------------------------------------------------------------------------
        | آمار وضعیت پرسنل
        |--------------------------------------------------------------------------
        */
        $activeEmployeesCount = Employee::where(
            'status',
            'فعال'
        )->count();

        $inactiveEmployeesCount = Employee::where(
            'status',
            'غیرفعال'
        )->count();

        $missionEmployeesCount = Employee::where(
            'status',
            'ماموریت'
        )->count();

        $leaveEmployeesCount = Employee::where(
            'status',
            'مرخصی'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Departments
        |--------------------------------------------------------------------------
        */
        $departments = Department::orderBy('name')->get();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */
        return view('employees.index', compact(
            'employees',
            'employeesCount',
            'departmentsCount',
            'activeEmployeesCount',
            'inactiveEmployeesCount',
            'missionEmployeesCount',
            'leaveEmployeesCount',
            'departments'
        ));
    }


    /**
     * فرم ایجاد پرسنل
     */
    public function create()
    {
       $departments = Department::query()
             ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('employees.create', compact('departments'));
    }


    /**
     * ذخیره پرسنل
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | اطلاعات هویتی
            |--------------------------------------------------------------------------
            */

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'father_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'national_code' => [
                'required',
                'string',
                'max:10',
                'unique:employees,national_code',
            ],

            'birth_certificate_number' => [
                'nullable',
                'string',
                'max:50',
            ],

            'marital_status' => [
                'nullable',
                'string',
                'max:50',
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],

            'promotion_date' => [
                'nullable',
                'date',
            ],

            /*
            |--------------------------------------------------------------------------
            | اطلاعات پرسنلی
            |--------------------------------------------------------------------------
            */

            'personnel_number' => [
                'required',
                'string',
                'max:50',
                'unique:employees,personnel_number',
            ],

            /*
            |--------------------------------------------------------------------------
            | اطلاعات سازمانی
            |--------------------------------------------------------------------------
            */

            'rank' => [
                'nullable',
                'string',
                'max:100',
            ],

            'job' => [
                'nullable',
                'string',
                'max:150',
            ],

            'position' => [
                'nullable',
                'string',
                'max:150',
            ],

            'service_branch' => [
                'nullable',
                'string',
                'max:150',
            ],

            'service_summary' => [
                'nullable',
                'string',
            ],

           'department_id' => [
               'required',
               'integer',
               'exists:departments,id',
            ],
            

            /*
            |--------------------------------------------------------------------------
            | مقطع تحصیلی
            |--------------------------------------------------------------------------
            */

            'education_level' => [
                'nullable',
                'in:دیپلم,فوق دیپلم,لیسانس,فوق لیسانس,دکتری',
            ],

            'education_field' => [
                'nullable',
                'string',
                'max:150',
            ],

            /*
            |--------------------------------------------------------------------------
            | وضعیت پرسنل
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                'in:فعال,غیرفعال,ماموریت,مرخصی',
            ],

            /*
            |--------------------------------------------------------------------------
            | اطلاعات تماس
            |--------------------------------------------------------------------------
            */

            'mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            'backup_mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            'home_phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'home_address' => [
                'nullable',
                'string',
            ],
        ]);

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'پرسنل با موفقیت ثبت شد.'
            );
    }


    /**
     * نمایش جزئیات پرسنل
     */
    /**
 * نمایش جزئیات پرسنل
 */



public function show(Employee $employee)
{
    $employee->load([
        'department',
    ]);

    $year = now()->year;

    $leaveBalances = LeaveBalance::query()
        ->where('employee_id', $employee->id)
        ->where('year', $year)
        ->get();

    $leaveBalance = [];

    foreach (LeaveType::cases() as $type) {

        $balance = $leaveBalances->first(
            fn ($item) => $item->leave_type === $type
        );

        $allowance = $balance?->allowance ?? 0;

        $used = LeaveRequest::query()
            ->where('employee_id', $employee->id)
            ->where('year', $year)
            ->where('leave_type', $type)
            ->approved()
            ->sum('days');

        $leaveBalance[$type->value] = [
    'leave_type' => $type,
    'allowance' => (int) $allowance,
    'used' => (int) $used,
    'remaining' => max(
        0,
        $allowance - $used
    ),
];
    }

    /*
    |--------------------------------------------------------------------------
    | Total Used Leave
    |--------------------------------------------------------------------------
    */

    $totalUsedLeave = LeaveRequest::query()
        ->where('employee_id', $employee->id)
        ->where('year', $year)
        ->approved()
        ->sum('days');

    /*
    |--------------------------------------------------------------------------
    | Leave Statistics
    |--------------------------------------------------------------------------
    */

    $leaveStatistics = [
        'total' => LeaveRequest::query()
            ->where('employee_id', $employee->id)
            ->where('year', $year)
            ->count(),

        'approved' => LeaveRequest::query()
            ->where('employee_id', $employee->id)
            ->where('year', $year)
            ->approved()
            ->count(),

        'pending' => LeaveRequest::query()
            ->where('employee_id', $employee->id)
            ->where('year', $year)
            ->pending()
            ->count(),

        'used_days' => (int) $totalUsedLeave,
    ];

    /*
    |--------------------------------------------------------------------------
    | Leave History
    |--------------------------------------------------------------------------
    */

    $leaveHistory = LeaveRequest::query()
        ->where('employee_id', $employee->id)
        ->where('year', $year)
        ->latest('id')
        ->get();

    return view(
        'employees.show',
        compact(
            'employee',
            'year',
            'leaveBalance',
            'totalUsedLeave',
            'leaveStatistics',
            'leaveHistory'
        )
    );
}





// {
//     /*
//     |--------------------------------------------------------------------------
//     | Employee Relations
//     |--------------------------------------------------------------------------
//     */

//     $employee->load([
//         'department',
//     ]);


//     /*
//     |--------------------------------------------------------------------------
//     | Current Year
//     |--------------------------------------------------------------------------
//     |
//     | فعلاً سال جاری جلالی را بر اساس سال میلادی محاسبه می‌کنیم.
//     | بعداً در مرحله نهایی تاریخ‌های پروژه را یکپارچه جلالی می‌کنیم.
//     |
//     */

//     $year = (int) now()->year - 621;


//     /*
//     |--------------------------------------------------------------------------
//     | Leave Balances
//     |--------------------------------------------------------------------------
//     */

//     $balances = LeaveBalance::query()
//         ->where('employee_id', $employee->id)
//         ->where('year', $year)
//         ->get()
//         ->keyBy(function ($balance) {
//             return $balance->leave_type->value;
//         });


//     /*
//     |--------------------------------------------------------------------------
//     | Normalize Leave Balance For View
//     |--------------------------------------------------------------------------
//     */

//     $leaveBalance = [];

//     foreach (LeaveType::cases() as $type) {

//         $balance = $balances->get($type->value);

//         if ($balance) {

//             $allowance = (int) $balance->allowance;
//             $used = (int) $balance->used_days;
//             $remaining = (int) $balance->remaining_days;

//         } else {

//             $allowance = 0;
//             $used = 0;
//             $remaining = 0;
//         }


//         $leaveBalance[$type->value] = [

//             'type' => $type,

//             'leave_type' => $type->value,

//             'allowance' => $allowance,

//             'used' => $used,

//             'remaining' => $remaining,
//         ];
//     }


//     /*
//     |--------------------------------------------------------------------------
//     | Leave Requests History
//     |--------------------------------------------------------------------------
//     */

//     $leaveHistory = LeaveRequest::query()
//         ->where('employee_id', $employee->id)
//         ->where('year', $year)
//         ->latest('id')
//         ->get();


//     /*
//     |--------------------------------------------------------------------------
//     | Leave Statistics
//     |--------------------------------------------------------------------------
//     */

//     $leaveStatistics = [

//         'total' => (clone $leaveHistory)->count(),

//         'approved' => (clone $leaveHistory)
//             ->where('status', LeaveStatus::APPROVED)
//             ->count(),

//         'pending' => (clone $leaveHistory)
//             ->where('status', LeaveStatus::PENDING)
//             ->count(),

//         'rejected' => (clone $leaveHistory)
//             ->where('status', LeaveStatus::REJECTED)
//             ->count(),

//         'used_days' => (clone $leaveHistory)
//             ->where('status', LeaveStatus::APPROVED)
//             ->sum('days'),
//     ];


//     /*
//     |--------------------------------------------------------------------------
//     | Return View
//     |--------------------------------------------------------------------------
//     */

//     return view(
//         'employees.show',
//         compact(
//             'employee',
//             'year',
//             'leaveBalance',
//             'leaveHistory',
//             'leaveStatistics'
//         )
//     );
// }




// p f show 31\6\2026 but has Eror 
// {
//     $employee->load([
//         'department',
//         'leaveRequests' => function ($query) {
//             $query
//                 ->latest('start_date')
//                 ->latest('id');
//         },
//     ]);

//     $year = now()->year;

//     $leaveBalance = $leaveBalanceService
//         ->getEmployeeBalance(
//             $employee,
//             $year
//         );

//     $totalUsedLeave = $leaveBalanceService
//         ->getTotalUsedDays(
//             $employee,
//             $year
//         );

//     return view(
//         'employees.show',
//         compact(
//             'employee',
//             'leaveBalance',
//             'totalUsedLeave',
//             'year'
//         )
//     );

// }


    /**
     * فرم ویرایش
     */
    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();

        return view(
            'employees.edit',
            compact(
                'employee',
                'departments'
            )
        );
    }


    /**
     * بروزرسانی اطلاعات پرسنل
     */
    public function update(
        Request $request,
        Employee $employee
    ) {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | اطلاعات هویتی
            |--------------------------------------------------------------------------
            */

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'father_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'national_code' => [
                'required',
                'string',
                'max:10',
                'unique:employees,national_code,' . $employee->id,
            ],

            'birth_certificate_number' => [
                'nullable',
                'string',
                'max:50',
            ],

            'marital_status' => [
                'nullable',
                'string',
                'max:50',
            ],

            'birth_date' => [
                'nullable',
                'date',
            ],

            'promotion_date' => [
                'nullable',
                'date',
            ],

            /*
            |--------------------------------------------------------------------------
            | اطلاعات پرسنلی
            |--------------------------------------------------------------------------
            */

            'personnel_number' => [
                'required',
                'string',
                'max:50',
                'unique:employees,personnel_number,' . $employee->id,
            ],

            /*
            |--------------------------------------------------------------------------
            | اطلاعات سازمانی
            |--------------------------------------------------------------------------
            */

            'rank' => [
                'nullable',
                'string',
                'max:100',
            ],

            'job' => [
                'nullable',
                'string',
                'max:150',
            ],

            'position' => [
                'nullable',
                'string',
                'max:150',
            ],

            'service_branch' => [
                'nullable',
                'string',
                'max:150',
            ],

            'service_summary' => [
                'nullable',
                'string',
            ],

                    'department_id' => [
                    'required',
                    'integer',
                    'exists:departments,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | مقطع تحصیلی
            |--------------------------------------------------------------------------
            */

            'education_level' => [
                'nullable',
                'in:دیپلم,فوق دیپلم,لیسانس,فوق لیسانس,دکتری',
            ],

            'education_field' => [
                'nullable',
                'string',
                'max:150',
            ],

            /*
            |--------------------------------------------------------------------------
            | وضعیت پرسنل
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                'in:فعال,غیرفعال,ماموریت,مرخصی',
            ],

            /*
            |--------------------------------------------------------------------------
            | اطلاعات تماس
            |--------------------------------------------------------------------------
            */

            'mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            'backup_mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            'home_phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'home_address' => [
                'nullable',
                'string',
            ],
        ]);

        $employee->update($validated);

        return redirect()
            ->route(
                'employees.show',
                $employee
            )
            ->with(
                'success',
                'اطلاعات پرسنل با موفقیت بروزرسانی شد.'
            );
    }


    /**
     * حذف نرم پرسنل
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with(
                'success',
                'پرسنل با موفقیت حذف شد.'
            );
    }
}
