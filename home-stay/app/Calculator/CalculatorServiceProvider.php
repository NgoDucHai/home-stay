<?php

namespace App\Calculator;

use App\Calculator\Operators\Addition;
use App\Calculator\Operators\Division;
use App\Calculator\Operators\Multiplication;
use App\Calculator\Operators\Subtraction;
use Illuminate\Support\ServiceProvider;

/**
 * Class CalculatorServiceProvider
 * @package App\Calculator
 */
class CalculatorServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Calculator::class, function ()
        {
            return new Calculator();
        });
    }

    public function boot()
    {
        /** @var Calculator $calculator */
        $calculator = $this->app->make(Calculator::class);

        $calculator
            ->setOperator('+', new Addition())
            ->setOperator('-', new Subtraction())
            ->setOperator('*', new Multiplication())
            ->setOperator('/', new Division())
        ;
    }

    public function provides()
    {
        return [
            Calculator::class
        ];
    }
}