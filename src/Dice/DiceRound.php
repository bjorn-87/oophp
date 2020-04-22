<?php
namespace Bjos\Dice;

/**
 * DiceHand class consists of dices.
 */
class DiceRound
{
    /**
     * @var int $value The value of the dice.
     */
    private $player;
    private $score;

    /**
     * Constructor to create a DiceRound.
     *
     * @param object $player The current player.
     */
    public function __construct(object $player)
    {
        $this->player = $player;
        $this->score = 0;
    }

    /**
     * Constructor to create a DiceHand.
     *
     * @return bool $dices The number of dices to create default 5.
     */
    public function playRound()
    {
        $this->player->roll();
        $values = $this->player->values();
        $one = in_array(1, $values);

        if ($one) {
            $this->score = 0;
            return $one;
        } else {
            $this->score += $this->player->sum();
            return $one;
        }
    }

    /**
     * Get score of round.
     *
     * @return int. $score The score for the round.
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Reset round score
     *
     *  @return void.
     */
    public function resetScore()
    {
        $this->score = 0;
    }
}
