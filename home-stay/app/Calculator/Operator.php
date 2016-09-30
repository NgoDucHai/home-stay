<?php

namespace App\Calculator;

/**
 * Represents a math operation
 *
 * Interface Operator
 * @package App\Calculator
 */
interface Operator
{
    /**
     * @param number $number1
     * @param number $number2
     * @return number
     */
    public function run($number1, $number2);
}