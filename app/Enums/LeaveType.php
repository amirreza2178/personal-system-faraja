<?php

namespace App\Enums;

enum LeaveType: string
{
    case ENTITLEMENT = 'entitlement';
    case ENCOURAGEMENT = 'encouragement';
    case SICK = 'sick';
    case CONTINUITY = 'continuity';

    public function label(): string
    {
        return match ($this) {
            self::ENTITLEMENT => 'مرخصی استحقاقی',
            self::ENCOURAGEMENT => 'مرخصی تشویقی',
            self::SICK => 'مرخصی استعلاجی',
            self::CONTINUITY => 'مرخصی مداومت',
        };
    }

    public function defaultAllowance(): int
    {
        return match ($this) {
            self::ENTITLEMENT => 30,
            self::ENCOURAGEMENT => 0,
            self::SICK => 0,
            self::CONTINUITY => 0,
        };
    }
}