<?php

declare(strict_types=1);

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace src;

class task9
{
    public function main(array $arr, int $number): array|bool
    {
        for ($i = 0; $i < \count($arr); ++$i) {
            if (\count($arr) < 3 || $number <= 0 || $arr[$i] < 0) {
                throw new \InvalidArgumentException();
            }
        }
        $countArr = \count($arr) - 2;
        $newArr = [];
        for ($i = 0; $i < $countArr; ++$i) {
            if ($arr[$i] + $arr[$i + 1] + $arr[$i + 2] === $number) {
                $newArr[] = "{$arr[$i]} + {$arr[$i + 1]} + {$arr[$i + 2]} = {$number}";
            }
        }

        return print_r($newArr);
    }
}

//$object = new Task9();
//echo $object->main([2, 7, 7, 1, 8, 2, 7, 8, 7], 16);
