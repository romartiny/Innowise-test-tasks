<?php

namespace src;

class Task10
{
    public function main(int $input): array|bool
    {
        if ($input <= 0) {
            throw new \InvalidArgumentException();
        }
        $newArr[] = $input;
        while ($input >= 2) {
            if ($input & 1) {
                $input = 3 * $input + 1;
                $newArr[] = $input;
            } else {
                $input = $input / 2;
                $newArr[] = $input;
            }
        }

        return print_r($newArr);
    }
}
