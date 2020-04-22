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
        <?= $game->getCurrentPlayerName() ?> Wins!
    </h2>

    <form class="postFormDice" action="play" method="post">
        <input type="submit" name="reset" value="Nytt Spel">
    </form>


</div>

</div>
