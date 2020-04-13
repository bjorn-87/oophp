<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the game;
    $guessGame = new Bjos\Guess\Guess();
    $_SESSION["number"] = $guessGame->number();
    $_SESSION["tries"] = $guessGame->tries();
    $_SESSION["res"] = null;

    return $app->response->redirect("guess/play");
});



/**
 * Play the game
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $doCheat = $_GET["doCheat"] ?? null;

    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $res = $_SESSION["res"] ?? null;

    $data = [
        "guess" => $guess,
        "tries" => $tries,
        "res" => $res,
        "doCheat" => $doCheat,
        "number" => $number,
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Handles the post request form and checks if doInit or doGuess button was pressed.
 */
$app->router->post("guess/play", function () use ($app) {
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;

    $_SESSION["guess"] = $guess;

    if ($doInit) {
        $_SESSION["number"] = null;
        $_SESSION["tries"] = null;
        return $app->response->redirect("guess/init");
    } elseif ($doGuess) {
        return $app->response->redirect("guess/make-guess");
    }
});



/**
 * Handles the guess and throws an exception if its not a number between 1-100.
 */
$app->router->get("guess/make-guess", function () use ($app) {
    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $guessGame = null;

    try {
        $guessGame = new Bjos\Guess\Guess($number, $tries);
        $res = $guessGame->makeGuess($guess);
        $_SESSION["tries"] = $guessGame->tries();
    } catch (Bjos\Guess\GuessException $e) {
        $res = "Not allowed, only values between 1 and 100: " . get_class($e);
    } if (intval($guess) === $number) {
        $_SESSION["res"] = $res;
        return $app->response->redirect("guess/end_win");
    } elseif ($guessGame->tries() <= 0) {
        $_SESSION["res"] = $res;
        return $app->response->redirect("guess/end_loose");
    } else {
        $_SESSION["res"] = $res;
        return $app->response->redirect("guess/play");
    }
});



/**
 * Redirect to page if player wins the game.
 */
$app->router->get("guess/end_win", function () use ($app) {
    $title = "You win!";

    $tries = $_SESSION["tries"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $res = $_SESSION["res"] ?? null;

    $data = [
        "guess" => $guess,
        "tries" => $tries,
        "res" => $res,
    ];

    $app->page->add("guess/end_win", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Redirect to page if player looses the game.
 */
$app->router->get("guess/end_loose", function () use ($app) {
    $title = "You loose!";

    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $res = $_SESSION["res"] ?? null;


    $data = [
        "guess" => $guess,
        "tries" => $tries,
        "res" => $res,
        "number" => $number,
    ];

    $app->page->add("guess/end_loose", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
