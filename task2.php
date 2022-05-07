<?php

namespace src;

class task2
{
    public function birthday($date): int
    {
        $inDate = explode('-', $date);
        $secondsInDay = 24 * 60 * 60;
        $today = date('Y-m-d');
        $newDate = date('Y-m-d', strtotime($today.' + 1 year'));
        $inToday = explode('-', $newDate);
        echo $inToday[0];
        $timeBirthday = mktime(0, 0, 0, $inDate[1], $inDate[2], $inDate[0]);

        if ($timeBirthday < $today) {
            $nextBirthDate = ((mktime(0, 0, 0, $inDate[1], $inDate[2], date('Y', strtotime($today.' + 1 year')))) - $today) / $secondsInDay;
        } else {
            $nextBirthDate = ((mktime(0, 0, 0, $inDate[1], $inDate[2], date('Y')))) - $today) / $secondsInDay;
        }

        return $nextBirthDate;
    }

    public function main($date): string
    {
        return $this->birthday($date);
    }
}

$object = new Task2();
echo $object->main('2031-03-21');
