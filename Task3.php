<?php

namespace src;

class Task3
{
    public function main(int $num): int
    {
        if ($num < 9 || !\is_int($num)) {
            throw new \InvalidArgumentException();
        }
        $sum = 0;

        while ($num > 0 || $sum > 9) {
            if (0 == $num) {
                $num = $sum;
                $sum = 0;
            }
            $sum = round(($num % 10) + $sum);
            $num = $num / 10;
        }

        return $sum;
    }
}
