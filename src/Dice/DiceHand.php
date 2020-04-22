<?php
namespace Bjos\Dice;

/**
 * DiceHand class consists of dices.
 */
class DiceHand
{
    /**
     * @var int $value The value of the dice.
     */
    private $dices;
    private $values;

    /**
     * Constructor to create a DiceHand.
     *
     * @param int $dices The number of dices to create default 5.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices = [];
        $this->values = [];


        for ($i=0; $i < $dices; $i++) {
            $this->dices[] = new Dice();
            $this->values[] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $counter = 0;
        foreach ($this->dices as $value) {
            $this->values[$counter] = $value->getDice();
            $counter += 1;
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return array_sum($this->values);
    }
}
