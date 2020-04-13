<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<div class="gameHeader">
    <p>Guess my number</p>
</div>
<div class="game">

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

<p class="win">You Win!</p>

<form class="postForm" method="post" action="play">
    <input type="submit" name="doInit" value="New game">
</form>

<p>Your guess <?= $guess ?> is <b style="color: green;"><?= $res ?></b></p>

</div>
