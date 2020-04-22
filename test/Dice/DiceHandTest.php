<?php

namespace Bjos\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoValues()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Bjos\Dice\DiceHand", $diceHand);

        $res = $diceHand->values()[0];
        $exp = null;
        $this->assertEquals($res, $exp);

        $res1 = $diceHand->values();
        $this->assertCount(5, $res1);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no argument.
     */
    public function testRollDices()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Bjos\Dice\DiceHand", $diceHand);

        $diceHand->roll();

        $res = $diceHand->values()[0];
        $this->assertIsInt($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no argument.
     */
    public function testWithMoreDices()
    {
        $diceHand = new DiceHand(7);
        $this->assertInstanceOf("\Bjos\Dice\DiceHand", $diceHand);

        $res = $diceHand->values();
        $this->assertCount(7, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no argument.
     */
    public function testSum()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Bjos\Dice\DiceHand", $diceHand);

        $diceHand->roll();

        $res = 0;
        for ($i=0; $i < 5; $i++) {
            $res += $diceHand->values()[$i];
        }

        $exp = $diceHand->sum();
        $this->assertEquals($res, $exp);
    }
}
