<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<div class="gameHeader">
    <p>Dicegame 100</p>
</div>
<div class="gameDiceScore">
    <table>
        <tr>
        <?php foreach ($players as $value) : ?>
            <th><?= $value ?></th>
        <?php endforeach; ?>
    </tr>
    <tr>
        <?php foreach ($score as $value) : ?>
                <td><?= $value ?></td>
        <?php endforeach; ?>
    </tr>
</table>
</div>


<div class="gameDice">
    <h2>
        Current player: <?= $game->getCurrentPlayerName() ?>
    </h2>
    <?php if ($game->checkGame()) : ?>
        <p>Last roll: <?= implode(", ", $game->getValues()) ?></p>
        <p>Sum of throw: <?= $game->getSum() ?></p>
        <p>Total points: <?= $game->getCurrentScore() ?></p>
        <?php if ($game->getCurrentPlayer() !== 0) : ?>
            <p>computer rolled: <?= $game->getRollCount() ?> times.</p>
        <?php endif; ?>
    <?php endif; ?>


    <form class="postFormDice" method="post">
        <?php if (!$game->checkOne()) : ?>
            <?php if ($game->getCurrentPlayer() === 0) : ?>
                <input type="submit" name="doit" value="Roll">
                <?php if ($game->checkGame()) : ?>
                    <input type="submit" name="save" value="save">
                <?php endif; ?>
            <?php elseif ($game->getCurrentPlayer() !== 0 && !$game->checkGame()) : ?>
                <input type="submit" name="doit" value="Roll for computer">
            <?php else : ?>
                <input type="submit" name="next" value="Players turn">
            <?php endif; ?>
        <?php else : ?>
                <?php if ($game->getCurrentPlayer() === 0) : ?>
                    <p>Sorry you got 1 and looses all points!</p>
                    <input type="submit" name="computer" value="Roll for computer">
                <?php else : ?>
                    <p>Computer got 1 and looses all points!</p>
                    <input type="submit" name="next" value="Players turn">
                <?php endif; ?>
        <?php endif; ?>
        <input type="submit" name="reset" value="reset">
    </form>
</div>
