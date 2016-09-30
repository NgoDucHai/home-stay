<?php

namespace App\Calculator\Operators;


use App\alculator\Operators\DivisionByZeroException;
use App\Calculator\Operator;

class Division implements Operator
{
    public function run($number1, $number2)
    {
        if($number2 == 0)
        {
            throw new DivisionByZeroException('Division by zero Exception');
        }

        return $number1 / $number2;
    }
}