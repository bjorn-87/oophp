<?php

namespace Bjos\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHistogramTest extends TestCase
{
    private $dice;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp() : void
    {
        $this->dice = new DiceHistogram();
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetHistogramMax()
    {
        $this->assertInstanceOf("Bjos\Dice100\DiceHistogram", $this->dice);

        $res = $this->dice->getHistogramMax();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testHistogramRoll()
    {
        $this->assertInstanceOf("Bjos\Dice100\DiceHistogram", $this->dice);

        $res = $this->dice->roll();
        $exp = 0;
        $this->assertGreaterThanOrEqual($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testHistogramSerie()
    {
        $this->assertInstanceOf("Bjos\Dice100\DiceHistogram", $this->dice);

        $res = $this->dice->getHistogramSerie();
        $this->assertIsArray($res);
    }
}
