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
<div class="gameDiceInit">

    <h2>Välj antal tärningar och spelarnamn.</h2>
    <form class="postFormDice" method="post">
        <label for="dices">Tärningar:</label>
        <input type="number" name="dices" value="3" min=1>
        <label for="name">Namn:</label>
        <input type="text" name="name" value="Player" required>
        <br>
        <br>
        <input type="submit" name="doit" value="Starta spel">
    </form>


</div>
