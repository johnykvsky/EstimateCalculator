<?php

use PHPUnit\Framework\TestCase;

class EstimateCalculatorTest extends TestCase
{
    public $estCalc;

    protected function setUp()
    {
        $this->estCalc = new johnykvsky\Utils\EstimateCalculator(4, 16, 8);
    }

    public function testApproximation()
    {
        $this->assertEquals(8.67, $this->estCalc->getApproximation());
    }

    public function testStandardDeviation()
    {
        $this->assertEquals(3.33, $this->estCalc->getStandardDeviation());
    }

    public function test68accuracy()
    {
        $this->assertEquals(12, $this->estCalc->get68accuracy());
    }

    public function test90accuracy()
    {
        $this->assertEquals(14, $this->estCalc->get90accuracy());
    }

    public function testSetValuesForCalculation()
    {
        $this->estCalc->setValuesForCalculation(2, 5, 7);
        $this->assertEquals(5.83, $this->estCalc->getApproximation());
        $this->assertEquals(1.17, $this->estCalc->getStandardDeviation());
        $this->assertEquals(7, $this->estCalc->get68accuracy());
        $this->assertEquals(7.7, $this->estCalc->get90accuracy());
    }
}
