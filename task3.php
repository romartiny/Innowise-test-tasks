<?php

namespace src;

class task3
{
    public function add(int $num): int
    {

        $sum = 0;

        while ($num > 0 || $sum > 9) {
            if (0 == $num) {
                $num = $sum;
                $sum = 0;
            }
            $sum = ($num % 10) + $sum;
            $num = $num / 10;
        }

        return $sum;
    }

    public function main(int $num): int
    {
        return $this->add($num);
    }
}

$object = new task3();
echo $object->main(5689);
