<?php

namespace src;

class Task2
{
    public function main(string $date): int
    {
        $inDate = explode('-', $date);
        $secondsInDay = 24 * 60 * 60;
        $today = date('Y-m-d');
        $inToday = explode('-', $today);
        $inYear = (int) $inToday[0];
        $time = time();
        $timeBirthday = mktime(0, 0, 0, $inDate[1], $inDate[2], $inDate[0]);
        if (!checkdate($inDate[0], $inDate[1], $inDate[2])) {
            throw new \InvalidArgumentException();
        }
        if ($inToday[1] === $inDate[1] && $inDate[2] === $inToday[2]) {
            return 0;
        }
        if ($timeBirthday < $time) {
            $nextBirthDate = (mktime(0, 0, 0, $inDate[1], $inDate[2], $inYear + 1) - $time) / $secondsInDay;
        } else {
            $nextBirthDate = (mktime(0, 0, 0, $inDate[1], $inDate[2], date('Y')) - $time) / $secondsInDay;
        }

        return round($nextBirthDate) + 1;
    }
}
