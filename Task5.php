<?php

namespace src;

class Task5
{
    public function main(int $n): string
    {
        if ($n <= 0) {
            throw new \InvalidArgumentException();
        }
        $n1 = '1';
        $n2 = '1';
        while (mb_strlen($n2) < $n) {
            $n3 = bcadd($n2, $n1);
            $n1 = $n2;
            $n2 = $n3;
        }

        return $n3;
    }
}