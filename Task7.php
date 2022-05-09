<?php

namespace src;

class Task7
{
    public function main(array $arr, int $position): array|string
    {
        if (empty($arr) || $position < 0 || \count($arr) <= $position) {
            throw new \InvalidArgumentException();
        }

        unset($arr[$position]);
        $newArr = array_values($arr);
        return print_r($newArr);
    }
}
