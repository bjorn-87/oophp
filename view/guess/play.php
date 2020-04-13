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

<form class="postForm" method="post" action="play">
    <input type="number" name="guess"><br>
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start Over">
</form>
<form class="postForm" method="get">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($res) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number ?>.</p>
<?php endif; ?>

</div>
