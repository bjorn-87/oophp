<?php

namespace Bjos\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class HistogramTest extends TestCase
{
    private $histogram;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp() : void
    {
        $this->histogram = new Histogram();
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $this->assertInstanceOf("Bjos\Dice100\Histogram", $this->histogram);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetSerie()
    {
        $this->assertInstanceOf("Bjos\Dice100\Histogram", $this->histogram);

        $res = $this->histogram->getSerie();
        $this->assertIsArray($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetAsText()
    {
        $this->assertInstanceOf("Bjos\Dice100\Histogram", $this->histogram);

        $res = $this->histogram->getAsText();
        $this->assertIsString($res);
    }
}
