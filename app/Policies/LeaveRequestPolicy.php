<?php

namespace App\Policies;

use App\Models\LeaveRequest;
use App\Models\User;

class LeaveRequestPolicy
{
    /**
     * فعلاً سیستم فقط یک کاربر مدیریتی دارد.
     *
     * بعداً در صورت اضافه شدن Role/Permission
     * قوانین دسترسی از همین‌جا توسعه داده می‌شوند.
     */

    public function approve(
        User $user,
        LeaveRequest $leaveRequest
    ): bool {
        return $user->exists
            && $leaveRequest->status === 'pending';
    }

    public function reject(
        User $user,
        LeaveRequest $leaveRequest
    ): bool {
        return $user->exists
            && $leaveRequest->status === 'pending';
    }
}