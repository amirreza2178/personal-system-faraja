<?php

namespace App\Enums;

enum LeaveStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'در انتظار تأیید',
            self::APPROVED => 'تأیید شده',
            self::REJECTED => 'رد شده',
            self::CANCELLED => 'لغو شده',
        };
    }
}