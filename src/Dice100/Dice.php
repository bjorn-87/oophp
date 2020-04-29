<?php
namespace Bjos\Dice100;

/**
 * Dice class
 */

class Dice
{
    /**
     * @var int $value The value of the dice.
     */
    private $lastRoll;
    private $sides;

    /**
     * Constructor to create a dice.
     *
     * @param null|integer $value The value of the dice.
     */
    public function __construct(int $sides = 6, int $lastRoll = null)
    {
        $this->lastRoll = $lastRoll;
        $this->sides = $sides;
    }

    /**
     * Method to get the value of the dice.
     *
     * @return int $value.
     */
    public function getDice()
    {
        $this->lastRoll = rand(1, $this->sides);
        return $this->lastRoll;
    }

    /**
     * Method to get the last roll of the dice.
     *
     * @return int $lastRoll.
     */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    /**
     * Method to get the sides of the dice.
     *
     * @return int $sides.
     */
    public function getSides()
    {
        return $this->sides;
    }
}
