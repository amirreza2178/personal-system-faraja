<?php

namespace App\Services;

use App\Enums\LeaveType;
use App\Helpers\JalaliHelper;
use App\Models\Employee;
use App\Models\LeaveBalance;

class LeaveBalanceService
{
    private const DEFAULT_ALLOWANCE = 30;

    /**
     * ایجاد سهمیه‌های پیش‌فرض پرسنل برای یک سال.
     *
     * هر پرسنل برای هر نوع مرخصی یک سهمیه مستقل دارد.
     */
    public function ensureForEmployee(
        Employee $employee,
        ?int $year = null
    ): void {
        $year ??= $this->currentJalaliYear();

        foreach (LeaveType::cases() as $leaveType) {
            LeaveBalance::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'year' => $year,
                    'leave_type' => $leaveType->value,
                ],
                [
                    'allowance' => self::DEFAULT_ALLOWANCE,
                ]
            );
        }
    }

    /**
     * دریافت سهمیه‌های یک پرسنل در یک سال.
     */
    public function getForEmployee(
        Employee $employee,
        ?int $year = null
    ) {
        $year ??= $this->currentJalaliYear();

        // اگر سهمیه‌های سال هنوز ساخته نشده باشند،
        // اینجا به صورت خودکار ساخته می‌شوند.
        $this->ensureForEmployee($employee, $year);

        return LeaveBalance::query()
            ->where('employee_id', $employee->id)
            ->where('year', $year)
            ->get()
            ->keyBy(function (LeaveBalance $balance) {
                return $balance->leave_type instanceof \BackedEnum
                    ? $balance->leave_type->value
                    : $balance->leave_type;
            });
    }

    /**
     * سال شمسی جاری.
     */
    public function currentJalaliYear(): int
    {
        return (int) substr(
            JalaliHelper::today(),
            0,
            4
        );
    }
}