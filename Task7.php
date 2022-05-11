<?php

namespace src;

class Task7
{
    public function main(array $arr, int $position): array
    {
        if (empty($arr) || $position < 0 || \count($arr) <= $position) {
            throw new \InvalidArgumentException();
        }
        unset($arr[$position]);

        return array_values($arr);
    }
}
