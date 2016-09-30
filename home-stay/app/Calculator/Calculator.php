<?php

namespace App\Calculator;

/**
 * A calculator with 2 numbers
 *
 * Class Calculator
 * @package App\Calculator
 */
class Calculator
{
    /**
     * @var Operator[]
     */
    protected $operators = [];

    /**
     * @param $operatorName
     * @param Operator $operatorInstance
     * @return self
     */
    public function setOperator($operatorName, Operator $operatorInstance)
    {
        $this->operators[$operatorName] = $operatorInstance;

        return $this;
    }

    /**
     * @param $operatorName
     * @return Operator
     * @throws OperatorNotSupportedException
     */
    public function getOperator($operatorName)
    {
        if ( ! array_key_exists($operatorName, $this->operators))
        {
            throw new OperatorNotSupportedException("Operator [$operatorName] is not supported");
        }

        return $this->operators[$operatorName];
    }

    /**
     * @param string $operatorName
     * @param $number1
     * @param $number2
     * @return number
     */
    public function calculate($operatorName, $number1, $number2)
    {
        return $this->getOperator($operatorName)->run($number1, $number2);
    }
}
