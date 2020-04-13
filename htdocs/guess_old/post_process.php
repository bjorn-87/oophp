<?php

require __DIR__ . "/config.php";
require __DIR__ . "/session.php";

$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;

$tries = $_SESSION["tries"] ?? null;
$_SESSION["doGuess"] = $doGuess;
$_SESSION["guess"] = $guess;
$guessGame = null;

if ($doInit) {
    $_SESSION["number"] = null;
    $_SESSION["tries"] = null;
    header("Location: index.php");
} elseif ($doGuess) {
    try {
        $guessGame = new Guess($number, $tries);
        $res = $guessGame->makeGuess($guess);
        $_SESSION["tries"] = $guessGame->tries();
    } catch (GuessException $e) {
        $res = "Not allowed, only values between 1 and 100: " . get_class($e);
    } if (intval($guess) === $number) {
        $_SESSION["res"] = $res;
        header("Location: endgame_win.php");
    } elseif ($guessGame->tries() <= 0) {
        $_SESSION["res"] = $res;
        header("Location: endgame_loose.php");
    } else {
        $_SESSION["res"] = $res;
        header("Location: index.php");
    }
}
