<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

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
        <?= $playerName ?> Wins!
    </h2>

    <form class="postFormDice" action="play" method="post">
        <input type="submit" name="reset" value="Nytt Spel">
    </form>


</div>
</div>
</div>
