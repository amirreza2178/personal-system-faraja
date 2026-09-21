<?php

namespace App\Http\Controllers;

use App\Enums\LeaveType;
use App\Models\Employee;
use App\Models\LeaveBalance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaveBalanceController extends Controller
{

    public function __construct(
    private LeaveBalanceService $leaveBalanceService
) {}

    /**
     * نمایش سهمیه مرخصی یک پرسنل
     */
   public function show(Employee $employee): View
{
    $year = $this->leaveBalanceService->currentJalaliYear();

    $balances = $this->leaveBalanceService
        ->getForEmployee($employee, $year);

    return view(
        'leave_requests.balance',
        compact('employee', 'year', 'balances')
    );
}


    /**
     * بروزرسانی سهمیه‌های مرخصی
     */
    public function update(
        Request $request,
        Employee $employee
    ): RedirectResponse {

        $validated = $request->validate(
            [
                'year' => [
                    'required',
                    'integer',
                    'min:1300',
                    'max:1500',
                ],

                'allowance' => [
                    'required',
                    'array',
                ],

                'allowance.*' => [
                    'required',
                    'integer',
                    'min:0',
                    'max:365',
                ],
            ],
            [
                'year.required' =>
                    'سال الزامی است.',

                'year.integer' =>
                    'سال وارد شده معتبر نیست.',

                'allowance.required' =>
                    'سهمیه مرخصی الزامی است.',

                'allowance.*.integer' =>
                    'مقدار سهمیه باید عدد صحیح باشد.',

                'allowance.*.min' =>
                    'سهمیه نمی‌تواند منفی باشد.',

                'allowance.*.max' =>
                    'سهمیه نمی‌تواند بیشتر از ۳۶۵ روز باشد.',
            ]
        );

        foreach ($validated['allowance'] as $leaveType => $allowance) {

            LeaveBalance::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'year' => $validated['year'],
                    'leave_type' => $leaveType,
                ],
                [
                    'allowance' => $allowance,
                ]
            );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'سهمیه‌های مرخصی با موفقیت ذخیره شد.'
            );
    }
}