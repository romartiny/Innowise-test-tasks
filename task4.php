<?php

namespace src;

class task4
{
    public function string(string $input): string
    {
        $patterns = ['/-/', '/_/'];
        $string = ucwords(preg_replace($patterns, ' ', $input));
        return str_replace(' ', '', $string);
    }

    public function main(string $input): string
    {
        return $this->string($input);
    }
}

$object = new task4();
echo $object->string('The quick-brown_fox jumps over the_lazy-dog');
