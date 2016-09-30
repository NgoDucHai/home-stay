<?php

use App\Calculator\Calculator;
use App\Calculator\Operator;
use App\Calculator\OperatorNotSupportedException;

class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    protected $calculator;

    public function setUp()
    {
        parent::setUp();

        $this->calculator = new Calculator();
    }

    public function testSetGetOperator()
    {
        $fakeOperator = \Mockery::mock(Operator::class);

        $this->calculator->setOperator('fakeOperator', $fakeOperator);

        $this->assertSame($fakeOperator, $this->calculator->getOperator('fakeOperator'));
    }

    /**
     * @expectedException App\Calculator\OperatorNotSupportedException
     */
    public function testGetOperatorShouldThrowOperatorExceptionNotSupportedWhenNoOperatorWasFound()
    {
        $this->calculator->getOperator('notExistedOperator');
    }

    public function testCalculateMethod()
    {
        $fakeOperator = \Mockery::mock(Operator::class);
        $fakeOperator->shouldReceive('run')->once()->withArgs([1, 2])->andReturn(10);

        $this->calculator->setOperator('fakeOperator', $fakeOperator);
        $result = $this->calculator->calculate('fakeOperator', 1, 2);

        $this->assertEquals(10, $result);
    }
}