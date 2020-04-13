<?php
require __DIR__ . "/config.php";
require __DIR__ . "/session.php";

if ($number === null) {
    $guessGame = new Guess;
    $_SESSION["number"] = $guessGame->number();
    $_SESSION["tries"] = $guessGame->tries();
}

$doGuess = $_SESSION["doGuess"] ?? null;
$tries = $_SESSION["tries"] ?? null;
$doCheat = $_GET["doCheat"] ?? null;

require __DIR__ . "/view/header.php";
require __DIR__ . "/view/guess_my_number.php";
