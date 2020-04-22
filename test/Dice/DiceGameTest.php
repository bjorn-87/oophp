<?php

namespace Bjos\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceGameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new DiceGame();
        $this->assertInstanceOf("\Bjos\Dice\DiceGame", $game);

        $res = $game->getCurrentPlayer();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res1 = $game->getCurrentPlayerName();
        $exp1 = "Human";
        $this->assertEquals($exp1, $res1);

        $res2 = $game->getPlayers()[0];
        $exp2 = "Human";
        $this->assertEquals($exp2, $res2);

        $res3 = $game->getPlayers()[1];
        $exp3 = "Computer 1";
        $this->assertEquals($exp3, $res3);

        $win = $game->checkWinner();
        $this->assertFalse($win);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testWinscoreTrue()
    {
        $game = new DiceGame("Human", 3, 2, 0);
        $this->assertInstanceOf("\Bjos\Dice\DiceGame", $game);

        $win = $game->checkWinner();
        $this->assertTrue($win);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testNextPlayer()
    {
        $game = new DiceGame();
        $this->assertInstanceOf("\Bjos\Dice\DiceGame", $game);

        $res = $game->getCurrentPlayer();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res1 = $game->getCurrentPlayerName();
        $exp1 = "Human";
        $this->assertEquals($exp1, $res1);

        $game->nextPlayer();

        $res2 = $game->getCurrentPlayer();
        $exp2 = 1;
        $this->assertEquals($exp2, $res2);

        $res3 = $game->getCurrentPlayerName();
        $exp3 = "Computer 1";
        $this->assertEquals($exp3, $res3);

        $game->nextPlayer();

        $res4 = $game->getCurrentPlayer();
        $exp4 = 0;
        $this->assertEquals($exp4, $res4);

        $res5 = $game->getCurrentPlayerName();
        $exp5 = "Human";
        $this->assertEquals($exp5, $res5);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetSumAndValues()
    {
        $game = new DiceGame();
        $this->assertInstanceOf("\Bjos\Dice\DiceGame", $game);

        $game->roll();
        $res = $game->getValues();
        $exp = $game->getSum();
        $this->assertEquals($exp, array_sum($res));
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testComputerRollAndCheckGame()
    {
        $game = new DiceGame();
        $this->assertInstanceOf("\Bjos\Dice\DiceGame", $game);

        $res = $game->checkGame();
        $this->assertFalse($res);

        $game->nextPlayer();
        $game->roll();

        $res1 = $game->getRollCount();
        $exp1 = 1;
        $this->assertGreaterThanOrEqual($exp1, $res1);

        $res2 = $game->checkGame();
        $this->assertTrue($res2);

        $game->saveTotalScore();

        $res3 = $game->getCurrentScore();
        $exp3 = 0;
        $this->assertEquals($exp3, $res3);

        $res4 = $game->checkOne();
        $this->assertIsBool($res4);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetTotalScore()
    {
        $game = new DiceGame();
        $this->assertInstanceOf("\Bjos\Dice\DiceGame", $game);

        $game->roll();
        $game->nextPlayer();
        $game->roll();

        $player = $game->getTotalScore()[0];
        $computer = $game->getTotalScore()[1];
        $res = $player + $computer;
        $exp = array_sum($game->getTotalScore());
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testChangeNameAndAddPlayers()
    {
        $game = new DiceGame("moped", 3, 4);
        $this->assertInstanceOf("\Bjos\Dice\DiceGame", $game);

        $res = $game->getCurrentPlayerName();
        $exp = "moped";
        $this->assertEquals($exp, $res);

        $game->nextPlayer();

        $res1 = $game->getCurrentPlayerName();
        $exp1 = "Computer 1";
        $this->assertEquals($exp1, $res1);

        $game->nextPlayer();

        $res2 = $game->getCurrentPlayerName();
        $exp2 = "Computer 2";
        $this->assertEquals($exp2, $res2);

        $game->nextPlayer();

        $res3 = $game->getCurrentPlayerName();
        $exp3 = "Computer 3";
        $this->assertEquals($exp3, $res3);
    }
}
