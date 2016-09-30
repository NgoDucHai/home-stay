<?php

namespace App\AdvanceCalculator;

use App\Calculator\Operator;

class Power implements Operator
{
    public function run($number1, $number2)
    {
        return pow($number1, $number2);
    }
}