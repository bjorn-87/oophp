<?php

namespace Bjos\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Bjos\Dice\Dice", $dice);

        $res = $dice->getLastRoll();
        $exp = null;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use only first argument.
     */
    public function testCreateObjectGetDice()
    {
        $dice = new Dice(10);
        $this->assertInstanceOf("\Bjos\Dice\Dice", $dice);

        $res = $dice->getDice();
        $exp = 11;
        $this->assertLessThan($exp, $res);

        $res1 = $dice->getDice();
        $exp1 = 0;
        $this->assertGreaterThan($exp1, $res1);

        $res2 = $dice->getDice();
        $this->assertIsInt($res2);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use only both argument.
     */
    public function testCreateObjectGetLastRoll()
    {
        $dice = new Dice(6, 30);
        $this->assertInstanceOf("\Bjos\Dice\Dice", $dice);

        $res = $dice->getLastRoll();
        $exp = 30;
        $this->assertEquals($exp, $res);
    }
}
