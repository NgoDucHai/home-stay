<?php

namespace App\Calculator\Operators;


use App\Calculator\Operator;

class Multiplication implements Operator
{
    public function run($number1, $number2)
    {
        return $number1 * $number2;
    }
}