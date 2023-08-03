<?php

namespace App\Helpers;

class StatsFormatter
{
    public static function formatStats($number)
    {
        if (floor($number) == $number) {
            return number_format($number, 0);
        } else {
            return number_format($number, 2);
        }
    }
}
