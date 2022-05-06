<?php

namespace src;

class Task1 {

    function result(int $inputNumber): string {
        return $inputNumber > 30 ? 'More than 30' : ($inputNumber > 20 ? 'More than 20' : ($inputNumber > 10 ? 'More than 10' : 'Less than 10'));
    }

    function main(int $inputNumber) : string {
        return $this->result($inputNumber);
    }
}

$object = new task1();
echo $object->main(12);


