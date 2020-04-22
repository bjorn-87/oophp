<?php
namespace Bjos\Dice;

/**
 * DiceHand class consists of dices.
 */
class DiceGame
{
    /**
    * @var string $name Name of the player.
     * @var int $dices Number of dices.
     * @var int $hands The number of players.
     * @var array $players array for all players
     * @var int $currentPlayer the index of the current player.
     * @var array $totalScore array for all players total score.
     * @var int $currentScore The round score for the player.
     * @var array $playerNames array for all players names.
     * @var int $winScore The score it takes to win the game.
     * @var int $rollCount how many times the computer has rolled in a round.
     * @var bool $gotOne stores the value if roll contains a 1.
     * @var bool $ongoingGame To see if a round is started.
     */
    private $name;
    private $dices;
    private $hands;
    private $players;
    private $currentPlayer;
    private $totalScore;
    private $currentScore;
    private $playerNames;
    private $winScore;
    private $rollCount;
    private $gotOne;
    private $ongoingGame;

    /**
     * Constructor to create a DiceHand.
     *
     * @param int $dices The number of dices to create default 5.
     */
    public function __construct(string $name = "Human", int $dices = 3, int $hands = 2, int $winScore = 100)
    {
        $this->hands = $hands;
        $this->players = [];
        $this->totalScore = [];
        $this->playerNames = [];
        $this->name = $name;
        $this->dices = $dices;
        $this->currentScore = 0;
        $this->currentPlayer = 0;
        $this->rollCount = 0;
        $this->gotOne = false;
        $this->ongoingGame = false;
        $this->winScore = $winScore;

        for ($i=0; $i < $hands; $i++) {
            $this->players[] = new DiceHand($dices);
            $this->totalScore[$i] = 0;
            if ($i === 0) {
                $this->playerNames[$i] = $name;
            } else {
                $this->playerNames[$i] = "Computer {$i}";
            }
        }
    }

    /**
     * Decides if a player rolls or a computer.
     *
     * @return void
     */
    public function roll()
    {
        $this->ongoingGame = true;
        $this->gotOne = false;
        if ($this->currentPlayer === 0) {
            $this->playerRoll();
        } else {
            $this->computerRoll();
        }
    }


    /**
     * Starts a new diceround for the player
     *
     * @return void
     */
    public function playerRoll()
    {
        $round = new DiceRound($this->players[$this->currentPlayer]);
        $one = $round->playRound();
        $this->currentScore += $round->getScore();
        $this->gotOne = $one;
    }


    /**
     * Starts a new diceround for the computer.
     *
     * @return void
     */
    public function computerRoll()
    {
        $this->rollCount = 0;
        $notOne = true;
        $round = new DiceRound($this->players[$this->currentPlayer]);

        while ($notOne) {
            $this->rollCount++;
            $hasOne = $round->playRound();
            $this->currentScore += $round->getScore();
            if ($hasOne) {
                $notOne = false;
            } elseif ($this->currentScore > 15) {
                $notOne = false;
            } elseif ($round->getScore() > 9) {
                $notOne = false;
            }
        }

        $this->gotOne = $hasOne;
        if (!$hasOne) {
            $this->totalScore[$this->currentPlayer] += $this->currentScore;
        }
    }


    /**
     * Switch to the next player.
     *
     * @return void
     */
    public function nextPlayer()
    {
        $this->ongoingGame = false;
        $this->gotOne = false;
        $this->currentPlayer++;
        $this->currentScore = 0;
        if ($this->currentPlayer === count($this->players)) {
            $this->currentPlayer = 0;
        }
    }

    /**
     * Gets rollcount for the computer round.
     *
     * @return int $rollCount
     */
    public function getRollCount()
    {
        return $this->rollCount;
    }



    /**
     * Checks if a player round is ongoing.
     *
     * @return bool $ongoingGame
     */
    public function checkGame()
    {
        return $this->ongoingGame;
    }




    /**
     * The values of dices in dicehand from currentPlayer
     *
     * @return array values of dicehand.
     */
    public function getValues()
    {
        return $this->players[$this->currentPlayer]->values();
    }



    /**
     * Gets the total sum of the DiceHand from currentPlayer
     *
     * @return int sum of all dices.
     */
    public function getSum()
    {
        return $this->players[$this->currentPlayer]->sum();
    }



    /**
     * Save round score of current player.
     *
     * @return void
     */
    public function saveTotalScore()
    {
        $this->totalScore[$this->currentPlayer] += $this->currentScore;
        $this->currentScore = 0;
    }



    /**
     * checks if last roll has a 1.
     *
     * @return bool $gotOne
     */
    public function checkOne()
    {
        return $this->gotOne;
    }

    /**
     * Return array with total score of all players.
     *
     * @return array
     */
    public function getTotalScore()
    {
        return $this->totalScore;
    }


    /**
     * Return the current playerscore.
     *
     * @return int $totalScore
     */
    public function getCurrentScore()
    {
        return $this->currentScore;
    }


    /**
     * Return array with all players names.
     *
     * @return array $playerNames
     */
    public function getPlayers()
    {
        return $this->playerNames;
    }

    /**
     * Return the index of the current player.
     *
     * @return int $currentPlayer
     */
    public function getCurrentPlayer()
    {
        return $this->currentPlayer;
    }

    /**
     * Return the current players name.
     *
     * @return string player name.
     */
    public function getCurrentPlayerName()
    {
        return $this->playerNames[$this->currentPlayer];
    }


    /**
     * checks if current player is the winner.
     *
     * @return bool
     */
    public function checkWinner()
    {
        if ($this->totalScore[$this->currentPlayer] >= $this->winScore) {
            return true;
        } else {
            return false;
        }
    }
}
