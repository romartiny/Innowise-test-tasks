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

class Task5
{
    public function bcaddFunction(string $str1, string $str2): string
    {
        $n1 = \strlen($str1);
        $n2 = \strlen($str2);
        $str3 = '';
        $diff = $n2 - $n1;
        $carry = 0;
        for ($i = $n1 - 1; $i >= 0; --$i) {
            $sum = ((\ord($str1[$i]) - \ord('0')) + ((\ord($str2[$i + $diff]) - \ord('0'))) + $carry);
            $str3 .= \chr($sum % 10 + \ord('0'));
            $carry = (int) ($sum / 10);
        }
        for ($i = $n2 - $n1 - 1; $i >= 0; --$i) {
            $sum = ((\ord($str2[$i]) - \ord('0')) + $carry);
            $str3 .= \chr($sum % 10 + \ord('0'));
            $carry = (int) ($sum / 10);
        }
        if ($carry) {
            $str3 .= \chr($carry + \ord('0'));
        }

        return strrev($str3);
    }

    public function main(int $n): string
    {
        if ($n <= 0) {
            throw new \InvalidArgumentException();
        }
        $n1 = '1';
        $n2 = '1';
        while (mb_strlen($n2) < $n) {
            $n3 = $this->bcaddFunction($n1, $n2);
            $n1 = $n2;
            $n2 = $n3;
        }

        return $n3;
    }
}
