<?php

namespace src;

class task7
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

$object = new Task7();
echo $object->main([1, 2, 3, 4, 5], 3);
