<?php

namespace src;

class task5
{
    public function fib(int $n): int
    {
        $fib = 0;
        $ter = 0;

        for ($i = 1; $i < $n; ++$i) {
            while ($fib <= 100) {
                $fib = round(((sqrt(5) + 1) / 2) ** $ter / sqrt(5));
                ++$ter;
            }
        }
        return $fib;
    }
}

$object = new task5();
echo $object->fib(12);
