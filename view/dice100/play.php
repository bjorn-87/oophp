<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<div class="gameDiceArea">
    <div class="gameHeaderDice">
        <p>Dicegame 100</p>
    </div>
<div class="dicePlayArea">


<div class="gameDiceScoreHist">
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
    <h3>Histogram</h3>
    <?= $histogram->getAsText() ?>
</div>


<div class="gameDice">
    <h2>
        Current player: <?= $playerName ?>
    </h2>
    <?php if ($checkGame) : ?>
        <p>Last roll: <?= implode(", ", $dices) ?></p>
        <p>Sum of throw: <?= $sum ?></p>
        <p>Total points: <?= $currentScore ?></p>
        <?php if ($currentPlayer !== 0) : ?>
            <p>computer rolled: <?= $rollCount ?> times.</p>
        <?php endif; ?>
    <?php endif; ?>



    <form class="postFormDice" method="post">
        <?php if (!$checkOne) : ?>
            <?php if ($currentPlayer === 0) : ?>
                <input type="submit" name="doIt" value="Roll">
                <?php if ($checkGame) : ?>
                    <input type="submit" name="save" value="save">
                <?php endif; ?>
            <?php elseif ($currentPlayer !== 0 && !$checkGame) : ?>
                <input type="submit" name="doIt" value="Roll for computer">
            <?php else : ?>
                <input type="submit" name="next" value="Players turn">
            <?php endif; ?>
        <?php else : ?>
                <?php if ($currentPlayer === 0) : ?>
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
</div>
</div>
