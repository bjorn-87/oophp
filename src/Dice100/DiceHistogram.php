<?php

namespace Bjos\Dice100;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram extends Dice implements HistogramInterface
{
    use HistogramTrait;



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return parent::getSides();
    }



    /**
     * Roll the dice, remember it's vlue in the serie and return it's value.
     *
     * @return int the value of the rolled dice.
     */
    public function roll()
    {
        $this->serie[] = parent::getDice();
        return $this->getLastRoll();
    }
}
