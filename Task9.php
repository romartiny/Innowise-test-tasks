<?php

namespace src;

class Task9
{
    public function main(array $arr, int $number): array
    {
        for ($i = 0; $i < \count($arr); ++$i) {
            if (\count($arr) < 3 || $number <= 0 || $arr[$i] < 0) {
                throw new \InvalidArgumentException();
            }
        }
        $countArr = \count($arr) - 2;
        $newArr = [];
        $resArr = [];
        for ($i = 0; $i < $countArr; ++$i) {
            if ($arr[$i] + $arr[$i + 1] + $arr[$i + 2] === $number) {
                $newArr[] = array("'{$arr[$i]} + {$arr[$i + 1]} + {$arr[$i + 2]} = {$number}'");
            }
        }

        return $newArr;
    }
}
