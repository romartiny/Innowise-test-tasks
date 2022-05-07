<?php

namespace src;

class task2
{
    public function birthday($date): int
    {
        $inDate = explode('-', $date);
        $secondsInDay = 24 * 60 * 60;
        $today = date('Y-m-d');
        $inToday = explode('-', $today);
        $inYear = (int) $inToday[0] + 1;
        $time = time();
        $timeBirthday = mktime(0, 0, 0, $inDate[1], $inDate[2], date('Y'));

        if ($timeBirthday < $time) {
            $nextBirthDate = (mktime(0, 0, 0, $inDate[1], $inDate[2], $inYear) - $time) / $secondsInDay;
        } else {
            $nextBirthDate = mktime(0, 0, 0, $inDate[1], $inDate[2], date('Y')) - $time / $secondsInDay;
        }

        return $nextBirthDate;
    }

    public function main($date): int
    {
        return $this->birthday($date);
    }
}

$object = new Task2();
echo $object->main('2001-03-21');
