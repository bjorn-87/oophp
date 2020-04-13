<?php

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");


session_name("bjosstud");
session_start();

$number = $_SESSION["number"] ?? null;
$guess = $_SESSION["guess"] ?? null;
$res = $_SESSION["res"] ?? null;
