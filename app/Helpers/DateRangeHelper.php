<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateRangeHelper
{
    public static function format(string|Carbon|null $start, string|Carbon|null $end, string $locale = 'id', bool $withDay = true): string
    {
        if (!$start && !$end) return '-';
        if (!$end) {
            $s = Carbon::parse($start)->locale($locale);
            return $withDay ? $s->isoFormat('dddd, D MMMM YYYY') : $s->isoFormat('D MMMM YYYY');
        }
        if (!$start) {
            $e = Carbon::parse($end)->locale($locale);
            return $withDay ? $e->isoFormat('dddd, D MMMM YYYY') : $e->isoFormat('D MMMM YYYY');
        }

        $start = Carbon::parse($start)->locale($locale);
        $end   = Carbon::parse($end)->locale($locale);

        $dayPrefix = $withDay ? $start->isoFormat('dddd, ') : '';

        if ($start->isSameDay($end)) {
            return $dayPrefix . $start->isoFormat('D MMMM YYYY');
        }

        if ($start->isSameMonth($end) && $start->isSameYear($end)) {
            return $start->isoFormat('D') . ' - ' . $end->isoFormat('D MMMM YYYY');
        }

        if ($start->isSameYear($end)) {
            return $start->isoFormat('D MMMM') . ' - ' . $end->isoFormat('D MMMM YYYY');
        }

        return $start->isoFormat('D MMMM YYYY') . ' - ' . $end->isoFormat('D MMMM YYYY');
    }
}
