<?php

namespace src;

class Task6
{
    public function main(int $year, int $lastYear, int $month, int $lastMonth, string $day = 'Monday'): int
    {
        if ($lastYear <= 0 || $year <= 0 || $month <= 0 || $lastMonth <= 0) {
            throw new \InvalidArgumentException();
        }
        $endDay = mktime(0, 0, 0, $lastMonth, 1, $lastYear);
        $startDay = mktime(0, 0, 0, $month, 1, $year);
        $counter = 0;
        $dateList = [];
        if ('Monday' == $day) {
            for ($i = $startDay; $i <= $endDay; $i += 86400) {
                $monday = date('d', $i);
                $current_day = date('w', $i);
                if (1 == $current_day && 1 == $monday) {
                    $fullDay = date('d-m-Y', $i);
                    $dateList[] = $fullDay;
                    ++$counter;
                }
            }
        }
        foreach ($dateList as $val) {
            echo $val, PHP_EOL;
        }
        return $counter;
    }
}
