<?php
namespace Bjos\Dice100;

/**
 * DiceHand class consists of dices.
 */
class DiceHand implements HistogramInterface
{
    use HistogramTrait;

    /**
     * @var int $value The value of the dice.
     */
    private $dices;
    private $values;
    private $sides;

    /**
     * Constructor to create a DiceHand.
     *
     * @param int $dices The number of dices to create default 5.
     */
    public function __construct(int $dices = 5, int $sides = 6)
    {
        $this->dices = [];
        $this->values = [];
        $this->sides = $sides;


        for ($i=0; $i < $dices; $i++) {
            $this->dices[] = new Dice($this->sides);
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
    public function getHistogramSerie()
    {
        return $this->values;
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
