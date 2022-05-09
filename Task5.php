<?php

namespace src;

class Task5
{
    public function fib(int $n): string
    {
        if ($n <= 0) {
            throw new \InvalidArgumentException();
        }

        $num = 0;
        $n1 = 0;
        $n2 = 1;
        while (mb_strlen($n2) < $n) {
            $n3 = $n2 + $n1;
            $n1 = $n2;
            $n2 = $n3;
            $num = $num + 1;
        }

        return (string) $n2;
    }

    public function main(int $n): string
    {
        return $this->fib($n);
    }
}

$object = new task5();
echo $object->main(12);
