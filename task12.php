<?php

namespace src;

class Task12
{
    public $first;
    public $second;
    protected $result;

    public function __construct($first, $second)
    {
        $this->first = $first;
        $this->second = $second;
        $this->result = '';
    }

    public function __toString()
    {
        return $this->result;
    }

    public function add()
    {
        $this->result = $this->first + $this->second;
        return $this;
    }

    public function subtract()
    {
        $this->result = $this->first - $this->second;
        return $this;
    }

    public function multiply()
    {
        $this->result = $this->first * $this->second;
        return $this;
    }

    public function divide()
    {
        if ($this->second === 0) {
            throw new \InvalidArgumentException();
        }
        $this->result = $this->first / $this->second;
        return $this;
    }

    public function AddBy(int $add)
    {
        $this->result += $add;
        return $this;
    }

    public function subtractBy(int $sub)
    {
        $this->result -= $sub;
        return $this;
    }

    public function multiplyBy(int $multi)
    {
        $this->result *= $multi;
        return $this;
    }

    public function divideBy(int $div)
    {
        if ($div == 0 || !is_int($div)) {
            throw new \InvalidArgumentException();
        }
        $this->result /= $div;
        return $this;
    }

}

//$myCalc = new Task12(12, 6);
//echo $myCalc->multiply()->divideBy(-12);
