<?php

namespace src;

class Task4
{
    public function main(string $input): string
    {
        $patterns = ['/-/', '/_/'];
        $string = ucwords(preg_replace($patterns, ' ', $input));

        return str_replace(' ', '', $string);
    }
}
