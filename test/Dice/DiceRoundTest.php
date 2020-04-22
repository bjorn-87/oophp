<?php

namespace Bjos\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceRoundTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObject()
    {
        $player = new DiceHand();
        $diceRound = new DiceRound($player);
        $this->assertInstanceOf("\Bjos\Dice\DiceHand", $player);
        $this->assertInstanceOf("\Bjos\Dice\DiceRound", $diceRound);
    }

    public function testGetScore()
    {
        $player = new DiceHand();
        $diceRound = new DiceRound($player);
        $this->assertInstanceOf("\Bjos\Dice\DiceHand", $player);
        $this->assertInstanceOf("\Bjos\Dice\DiceRound", $diceRound);

        $res = $diceRound->getScore();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $diceRound->playRound();

        $res1 = $diceRound->resetScore();
        $exp1 = 0;
        $this->assertEquals($exp1, $res1);
    }

    public function testPlayRound()
    {
        $player = new DiceHand(5);
        $diceRound = new DiceRound($player);
        $this->assertInstanceOf("\Bjos\Dice\DiceHand", $player);
        $this->assertInstanceOf("\Bjos\Dice\DiceRound", $diceRound);

        $res = $diceRound->playRound();
        $this->assertIsBool($res);

        $res1 = $diceRound->getScore();
        $exp1 = 30;
        $this->assertLessThanOrEqual($exp1, $res1);
    }
}
