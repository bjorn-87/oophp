<div class="game">

<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left.</p>

<h1 class="loose">You Loose!</h1>

<form class="postForm" method="post" action="post_process.php">
    <input type="submit" name="doInit" value="Start from beginning">
</form>

<p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>

<p>Right number was <?= $number ?>.</p>

</div>
