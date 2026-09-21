<?php

namespace App\Rules;

use App\Helpers\JalaliHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Throwable;

class ValidJalaliDate implements ValidationRule
{
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        if (! is_string($value) || trim($value) === '') {
            $fail('تاریخ وارد شده الزامی است.');

            return;
        }

        try {
            JalaliHelper::toGregorian($value);
        } catch (Throwable) {
            $fail('تاریخ وارد شده معتبر نیست. مثال: ۱۴۰۵/۰۶/۱۳');
        }
    }
}