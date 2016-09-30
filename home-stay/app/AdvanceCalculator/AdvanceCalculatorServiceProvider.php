<?php

namespace App\AdvanceCalculator;


use App\Calculator\Calculator;
use Illuminate\Support\ServiceProvider;

class AdvanceCalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // TODO: Implement register() method.
    }

    public function boot()
    {
        /** @var Calculator $calculator */
        $calculator = $this->app->make(Calculator::class);

        $calculator->setOperator('^', new Power());
    }

}