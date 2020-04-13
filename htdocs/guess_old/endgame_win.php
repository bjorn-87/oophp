<?php
require __DIR__ . "/config.php";
require __DIR__ . "/session.php";


// var_dump($guessGame);
// var_dump($_SESSION);

$tries = $_SESSION["tries"] ?? null;
$doCheat = $_GET["doCheat"] ?? null;

require __DIR__ . "/view/header.php";
require __DIR__ . "/view/end_win.php";
