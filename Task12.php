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
        if (0 === $this->second) {
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
        if (0 == $div || !\is_int($div)) {
            throw new \InvalidArgumentException();
        }
        $this->result /= $div;
        return $this;
    }
}

