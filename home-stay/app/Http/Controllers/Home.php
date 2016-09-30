<?php

namespace App\Http\Controllers;

use App\Calculator\Calculator;

class Home extends Controller
{
    protected $calculator;

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function add($number1, $number2)
    {
        return $this->calculator->calculate('+', $number1, $number2);
    }

    public function pow($number1, $number2)
    {
        return $this->calculator->calculate('^', $number1, $number2);
    }
}