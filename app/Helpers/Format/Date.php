<?php

namespace App\Helpers\Format;

use Hekmatinasser\Verta\Verta;
use Morilog\Jalali\CalendarUtils;

class Date
{
    public static function toCarbonDateFormat($date): string
    {
        $date = Number::toEnglish($date);
        return CalendarUtils::createCarbonFromFormat('Y/m/d', $date)->format('Y-m-d');
    }

    public static function toJalaliFormat($date): string
    {
        return verta($date)->formatJalaliDate();
    }
}
