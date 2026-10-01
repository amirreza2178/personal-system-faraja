<?php

namespace App\Services;

use App\Helpers\JalaliHelper;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LeaveRequestService
{

    public function __construct(
    private LeaveBalanceService $leaveBalanceService
) {}

    /**
     * Create a new leave request.
     */
    public function create(array $data): LeaveRequest
    {
        return DB::transaction(function () use ($data) {
            $dates = $this->prepareDates(
                $data['start_date'],
                $data['end_date']
            );

            $leaveType = $this->normalizeLeaveType(
                $data['leave_type']
            );

            $this->ensureNoOverlap(
                employeeId: (int) $data['employee_id'],
                startDate: $dates['start_date'],
                endDate: $dates['end_date']
            );

            $balance = $this->getLeaveBalance(
                employeeId: (int) $data['employee_id'],
                year: $dates['year'],
                leaveType: $leaveType
            );

            if ($dates['days'] > $balance->remaining_days) {
                throw ValidationException::withMessages([
                    'start_date' => sprintf(
                        'موجودی مرخصی کافی نیست. موجودی فعلی: %d روز.',
                        $balance->remaining_days
                    ),
                ]);
            }

            return LeaveRequest::create([
                'employee_id' => $data['employee_id'],
                'leave_type' => $leaveType,
                'status' => 'pending',
                'start_date' => $dates['start_date'],
                'end_date' => $dates['end_date'],
                'days' => $dates['days'],
                'year' => $dates['year'],
                'description' => $data['description'] ?? null,
            ]);
        });
    }

    /**
     * Update an existing leave request.
     */
    public function update(
        LeaveRequest $leaveRequest,
        array $data
    ): LeaveRequest {
        return DB::transaction(function () use ($leaveRequest, $data) {
            $dates = $this->prepareDates(
                $data['start_date'],
                $data['end_date']
            );

            $leaveType = $this->normalizeLeaveType(
                $data['leave_type']
            );

            $this->ensureNoOverlap(
                employeeId: (int) $data['employee_id'],
                startDate: $dates['start_date'],
                endDate: $dates['end_date'],
                exceptId: $leaveRequest->id
            );

            $balance = $this->getLeaveBalance(
                employeeId: (int) $data['employee_id'],
                year: $dates['year'],
                leaveType: $leaveType
            );

            $currentApprovedDays = 0;

            $currentLeaveType = $this->normalizeLeaveType(
                $leaveRequest->leave_type
            );

            if (
                $leaveRequest->status === 'approved'
                && (int) $leaveRequest->employee_id === (int) $data['employee_id']
                && (int) $leaveRequest->year === (int) $dates['year']
                && $currentLeaveType === $leaveType
            ) {
                $currentApprovedDays = (int) $leaveRequest->days;
            }

            $availableDays =
                $balance->remaining_days + $currentApprovedDays;

            if ($dates['days'] > $availableDays) {
                throw ValidationException::withMessages([
                    'start_date' => sprintf(
                        'موجودی مرخصی کافی نیست. حداکثر روز قابل استفاده: %d روز.',
                        $availableDays
                    ),
                ]);
            }

            $leaveRequest->update([
                'employee_id' => $data['employee_id'],
                'leave_type' => $leaveType,
                'start_date' => $dates['start_date'],
                'end_date' => $dates['end_date'],
                'days' => $dates['days'],
                'year' => $dates['year'],
                'description' => $data['description'] ?? null,
            ]);

            return $leaveRequest->refresh();
        });
    }

    /**
     * Approve a leave request.
     */
    public function approve(LeaveRequest $leaveRequest): LeaveRequest
{
    return DB::transaction(function () use ($leaveRequest) {

        $leaveRequest->refresh();

        /*
        |--------------------------------------------------------------------------
        | فقط درخواست Pending قابل تأیید است
        |--------------------------------------------------------------------------
        */
       if ($this->statusValue($leaveRequest->status) !== 'pending') {
    throw ValidationException::withMessages([
        'status' => 'فقط درخواست‌های در انتظار بررسی قابل تأیید هستند.',
    ]);
}

        /*
        |--------------------------------------------------------------------------
        | پیدا کردن سهمیه
        |--------------------------------------------------------------------------
        */
        $leaveType = $this->normalizeLeaveType(
            $leaveRequest->leave_type
        );

        $balance = LeaveBalance::query()
            ->where('employee_id', $leaveRequest->employee_id)
            ->where('year', $leaveRequest->year)
            ->where('leave_type', $leaveType)
            ->lockForUpdate()
            ->first();

        if (! $balance) {
            throw ValidationException::withMessages([
                'status' =>
                    'برای این پرسنل، سال و نوع مرخصی سهمیه‌ای تعریف نشده است.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | محاسبه مرخصی‌های مصرف‌شده
        |--------------------------------------------------------------------------
        */
        $usedDays = LeaveRequest::query()
            ->where('employee_id', $leaveRequest->employee_id)
            ->where('year', $leaveRequest->year)
            ->where(
                'leave_type',
                $leaveType
            )
            ->where('status', 'approved')
            ->where('id', '!=', $leaveRequest->id)
            ->sum('days');

        $remainingDays = max(
            0,
            (int) $balance->allowance - (int) $usedDays
        );

        /*
        |--------------------------------------------------------------------------
        | بررسی موجودی
        |--------------------------------------------------------------------------
        */
        if ((int) $leaveRequest->days > $remainingDays) {
            throw ValidationException::withMessages([
                'status' => sprintf(
                    'موجودی مرخصی کافی نیست. موجودی فعلی: %d روز.',
                    $remainingDays
                ),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | تأیید نهایی
        |--------------------------------------------------------------------------
        */
        $leaveRequest->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        return $leaveRequest->refresh();
    });
}

    /**
     * Reject a leave request.
     */
    public function reject(
        LeaveRequest $leaveRequest,
        ?string $reason = null
    ): LeaveRequest {
        return DB::transaction(function () use (
            $leaveRequest,
            $reason
        ) {
            $leaveRequest->refresh();

           if ($this->statusValue($leaveRequest->status) !== 'pending') {
    throw ValidationException::withMessages([
        'status' => 'فقط درخواست‌های در انتظار بررسی قابل رد هستند.',
    ]);
}

            $leaveRequest->update([
                'status' => 'rejected',
                'approved_by' => auth()->id(),
                'approved_at' => null,
                'rejection_reason' => $reason,
            ]);

            return $leaveRequest->refresh();
        });
    }

    /**
     * Prepare and validate Jalali dates.
     */
    private function prepareDates(
        string $startDate,
        string $endDate
    ): array {
        $startGregorian = JalaliHelper::toGregorian($startDate);
        $endGregorian = JalaliHelper::toGregorian($endDate);

        $start = Carbon::parse($startGregorian);
        $end = Carbon::parse($endGregorian);

        if ($end->lt($start)) {
            throw ValidationException::withMessages([
                'end_date' =>
                    'تاریخ پایان نمی‌تواند قبل از تاریخ شروع باشد.',
            ]);
        }

        $startJalali = JalaliHelper::toJalali(
            $startGregorian,
            'Y/m/d'
        );

        $endJalali = JalaliHelper::toJalali(
            $endGregorian,
            'Y/m/d'
        );

        $startYear = (int) substr($startJalali, 0, 4);
        $endYear = (int) substr($endJalali, 0, 4);

        if ($startYear !== $endYear) {
            throw ValidationException::withMessages([
                'end_date' =>
                    'بازه مرخصی نمی‌تواند بین دو سال شمسی قرار بگیرد.',
            ]);
        }

        return [
            'start_date' => $startGregorian,
            'end_date' => $endGregorian,
            'days' => $start->diffInDays($end) + 1,
            'year' => $startYear,
        ];
    }

    /**
     * Prevent overlapping leave requests.
     */
    private function ensureNoOverlap(
        int $employeeId,
        string $startDate,
        string $endDate,
        ?int $exceptId = null
    ): void {
        $query = LeaveRequest::query()
            ->where('employee_id', $employeeId)
           ->whereIn('status', ['pending', 'approved'])
            ->whereDate('start_date', '<=', $endDate)
            ->whereDate('end_date', '>=', $startDate);

        if ($exceptId !== null) {
            $query->where('id', '!=', $exceptId);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'start_date' =>
                    'این بازه با یکی از مرخصی‌های ثبت‌شده پرسنل تداخل دارد.',
            ]);
        }
    }

    /**
     * Get employee leave balance.
     */
  private function getLeaveBalance(
    int $employeeId,
    int $year,
    string $leaveType
): LeaveBalance {
    $employee = Employee::query()->findOrFail($employeeId);

    $this->leaveBalanceService->ensureForEmployee(
        $employee,
        $year
    );

    $balance = LeaveBalance::query()
        ->where('employee_id', $employeeId)
        ->where('year', $year)
        ->where('leave_type', $leaveType)
        ->first();

    if (! $balance) {
        throw ValidationException::withMessages([
            'leave_type' =>
                'سهمیه این نوع مرخصی برای پرسنل پیدا نشد.',
        ]);
    }

    return $balance;
}

    /**
     * Normalize enum/string leave type values.
     */
    private function normalizeLeaveType(mixed $leaveType): string
    {
        return $leaveType instanceof \BackedEnum
            ? (string) $leaveType->value
            : (string) $leaveType;
    }

    private function statusValue(mixed $status): string
{
    return $status instanceof \BackedEnum
        ? (string) $status->value
        : (string) $status;
}


}