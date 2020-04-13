<div class="game">
<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

<form class="postForm" method="post" action="post_process.php">
    <input type="number" name="guess"><br>
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start Over">
</form>
<form class="postForm" method="get">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number ?>.</p>
<?php endif; ?>

</div>
