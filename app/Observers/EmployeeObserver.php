<?php

namespace App\Observers;

use App\Helpers\JalaliHelper;
use App\Models\Employee;
use App\Services\LeaveBalanceService;

class EmployeeObserver
{
    public function created(Employee $employee): void
    {
        app(LeaveBalanceService::class)
            ->ensureForEmployee(
                $employee,
                (int) substr(
                    JalaliHelper::today(),
                    0,
                    4
                )
            );
    }
}