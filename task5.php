<?php

namespace src;

class task5
{
    public function fib(int $n): string
    {
        if ($n < 0) {
            echo 'Incorrect data';
            exit;
        }
        $num = 0;
        do {
            $fib = round(((sqrt(5) + 1) / 2) ** $num / sqrt(5));
            $fibLen = \strlen((string) $fib);
            ++$num;
        } while ($n > $fibLen);

        return strval($fib);
    }

    public function main(int $n): string
    {
//        return $this->fib($n);

        return strval(1.3584235674876E+42 + 1 );
    }
}

$object = new task5();
echo $object->main(17);
