<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use InvalidArgumentException;

class JalaliHelper
{
    /**
     * تبدیل تاریخ میلادی به جلالی و نمایش با فرمت دلخواه
     */
    public static function format(
        CarbonInterface|string|null $date,
        string $format = 'Y/m/d'
    ): ?string {
        if (! $date) {
            return null;
        }

        $carbon = $date instanceof CarbonInterface
            ? $date
            : Carbon::parse($date);

        [$jy, $jm, $jd] = self::gregorianToJalali(
            (int) $carbon->year,
            (int) $carbon->month,
            (int) $carbon->day
        );

        return self::formatJalali(
            $jy,
            $jm,
            $jd,
            $format
        );
    }


    /**
     * تاریخ امروز به صورت جلالی
     */
    public static function today(
        string $format = 'Y/m/d'
    ): string {
        return self::format(
            now(),
            $format
        );
    }


    /**
     * تبدیل تاریخ جلالی به میلادی
     */
    public static function toGregorian(
        string $jalaliDate,
        string $format = 'Y-m-d'
    ): string {
        [$jy, $jm, $jd] =
            self::parseJalaliDate($jalaliDate);

        [$gy, $gm, $gd] =
            self::jalaliToGregorian(
                $jy,
                $jm,
                $jd
            );

        return Carbon::create(
            $gy,
            $gm,
            $gd
        )->format($format);
    }


    /**
     * تبدیل تاریخ میلادی به جلالی
     */
    public static function toJalali(
        string $gregorianDate,
        string $format = 'Y/m/d'
    ): string {
        return self::format(
            $gregorianDate,
            $format
        );
    }


    /**
     * تجزیه تاریخ جلالی
     */
    private static function parseJalaliDate(
        string $date
    ): array {

        $date = trim($date);

        /*
        |--------------------------------------------------------------------------
        | تبدیل اعداد فارسی و عربی به انگلیسی
        |--------------------------------------------------------------------------
        */

        $date = strtr($date, [

            '۰' => '0',
            '۱' => '1',
            '۲' => '2',
            '۳' => '3',
            '۴' => '4',
            '۵' => '5',
            '۶' => '6',
            '۷' => '7',
            '۸' => '8',
            '۹' => '9',

            '٠' => '0',
            '١' => '1',
            '٢' => '2',
            '٣' => '3',
            '٤' => '4',
            '٥' => '5',
            '٦' => '6',
            '٧' => '7',
            '٨' => '8',
            '٩' => '9',
        ]);


        $parts = preg_split(
            '/[\/\-]/',
            $date
        );


        if (count($parts) !== 3) {

            throw new InvalidArgumentException(
                'فرمت تاریخ شمسی صحیح نیست. مثال: ۱۴۰۵/۰۶/۱۳'
            );
        }


        $jy = (int) $parts[0];
        $jm = (int) $parts[1];
        $jd = (int) $parts[2];


        if (! self::isValidJalaliDate(
            $jy,
            $jm,
            $jd
        )) {

            throw new InvalidArgumentException(
                'تاریخ شمسی وارد شده معتبر نیست.'
            );
        }


        return [
            $jy,
            $jm,
            $jd,
        ];
    }


    /**
     * اعتبارسنجی تاریخ جلالی
     */
    public static function isValidJalaliDate(
        int $jy,
        int $jm,
        int $jd
    ): bool {

        if (
            $jy < 1 ||
            $jm < 1 ||
            $jm > 12 ||
            $jd < 1
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | ماه‌های اول تا ششم
        |--------------------------------------------------------------------------
        */

        if ($jm <= 6) {

            return $jd <= 31;
        }


        /*
        |--------------------------------------------------------------------------
        | ماه‌های هفتم تا یازدهم
        |--------------------------------------------------------------------------
        */

        if ($jm <= 11) {

            return $jd <= 30;
        }


        /*
        |--------------------------------------------------------------------------
        | اسفند
        |--------------------------------------------------------------------------
        */

        return $jd <= (
            self::isLeapJalaliYear($jy)
                ? 30
                : 29
        );
    }


    /**
     * تشخیص کبیسه بودن سال جلالی
     */
    public static function isLeapJalaliYear(
        int $year
    ): bool {

        /*
        |--------------------------------------------------------------------------
        | اگر ۳۰ اسفند را تبدیل کنیم و دوباره
        | به ۳۰ اسفند برگردد، سال کبیسه است.
        |--------------------------------------------------------------------------
        */

        [$gy, $gm, $gd] =
            self::jalaliToGregorian(
                $year,
                12,
                30
            );

        [$jy, $jm, $jd] =
            self::gregorianToJalali(
                $gy,
                $gm,
                $gd
            );

        return (
            $jy === $year &&
            $jm === 12 &&
            $jd === 30
        );
    }


    /**
     * فرمت‌دهی تاریخ جلالی
     */
    private static function formatJalali(
        int $year,
        int $month,
        int $day,
        string $format
    ): string {

        return strtr(
            $format,
            [
                'Y' => (string) $year,

                'm' => str_pad(
                    (string) $month,
                    2,
                    '0',
                    STR_PAD_LEFT
                ),

                'd' => str_pad(
                    (string) $day,
                    2,
                    '0',
                    STR_PAD_LEFT
                ),
            ]
        );
    }


    /**
     * میلادی ← جلالی
     *
     * الگوریتم استاندارد
     */
    private static function jalaliToGregorian(
        int $jy,
        int $jm,
        int $jd
    ): array {

        $jDaysInMonth = [
            31,
            31,
            31,
            31,
            31,
            31,
            30,
            30,
            30,
            30,
            30,
            29,
        ];


        $jy -= 979;

        $jm -= 1;

        $jd -= 1;


        $jDayNo =
            365 * $jy
            + intdiv($jy, 33) * 8
            + intdiv(
                ($jy % 33) + 3,
                4
            );


        for (
            $i = 0;
            $i < $jm;
            $i++
        ) {

            $jDayNo +=
                $jDaysInMonth[$i];
        }


        $jDayNo += $jd;


        $gDayNo =
            $jDayNo + 79;


        $gy =
            1600
            + 400 * intdiv(
                $gDayNo,
                146097
            );


        $gDayNo %= 146097;


        $leap = true;


        if ($gDayNo >= 36525) {

            $gDayNo--;

            $gy +=
                100 * intdiv(
                    $gDayNo,
                    36524
                );

            $gDayNo %= 36524;


            if ($gDayNo >= 365) {

                $gDayNo++;

            } else {

                $leap = false;
            }
        }


        $gy +=
            4 * intdiv(
                $gDayNo,
                1461
            );


        $gDayNo %= 1461;


        if ($gDayNo >= 366) {

            $leap = false;

            $gDayNo--;

            $gy +=
                intdiv(
                    $gDayNo,
                    365
                );

            $gDayNo %= 365;
        }


        $gDaysInMonth = [
            31,
            $leap ? 29 : 28,
            31,
            30,
            31,
            30,
            31,
            31,
            30,
            31,
            30,
            31,
        ];


        $gm = 0;


        while (
            $gm < 12 &&
            $gDayNo >= $gDaysInMonth[$gm]
        ) {

            $gDayNo -=
                $gDaysInMonth[$gm];

            $gm++;
        }


        $gd =
            $gDayNo + 1;


        return [
            $gy,
            $gm + 1,
            $gd,
        ];
    }


    /**
     * جلالی ← میلادی
     */
    private static function gregorianToJalali(
        int $gy,
        int $gm,
        int $gd
    ): array {

        $gDaysInMonth = [
            31,
            28,
            31,
            30,
            31,
            30,
            31,
            31,
            30,
            31,
            30,
            31,
        ];


        $gy2 =
            $gm > 2
                ? $gy + 1
                : $gy;


        $days =
            355666
            + (365 * $gy)
            + intdiv(
                $gy2 + 3,
                4
            )
            - intdiv(
                $gy2 + 99,
                100
            )
            + intdiv(
                $gy2 + 399,
                400
            )
            + $gd;


        for (
            $i = 0;
            $i < $gm - 1;
            $i++
        ) {

            $days +=
                $gDaysInMonth[$i];
        }


        $jy =
            -1595
            + 33 * intdiv(
                $days,
                12053
            );


        $days %= 12053;


        $jy +=
            4 * intdiv(
                $days,
                1461
            );


        $days %= 1461;


        if ($days > 365) {

            $jy +=
                intdiv(
                    $days - 1,
                    365
                );

            $days =
                ($days - 1) % 365;
        }


        if ($days < 186) {

            $jm =
                1 + intdiv(
                    $days,
                    31
                );

            $jd =
                1 + ($days % 31);

        } else {

            $jm =
                7 + intdiv(
                    $days - 186,
                    30
                );

            $jd =
                1 + (
                    ($days - 186) % 30
                );
        }


        return [
            $jy,
            $jm,
            $jd,
        ];
    }
}

