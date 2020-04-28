<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Set up page for the game.
 */
$app->router->get("dice/init", function () use ($app) {
    $title = "init";

    $app->page->add("dice/init");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Init the game and redirect to play the game.
 */
$app->router->post("dice/init", function () use ($app) {
    // init the session for the game;
    $name = $_POST["name"];
    $dices = $_POST["dices"];

    $diceGame = new Bjos\Dice\DiceGame($name, $dices);
    $_SESSION["diceGame"] = $diceGame;

    return $app->response->redirect("dice/play");
});



/**
 * Play the game
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["diceGame"] ?? null;
    $score = $game->getTotalScore();
    $players = $game->getPlayers();

    $data = [
        "game" => $game,
        "score" => $score,
        "players" => $players,
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Handles the post request form and redirects.
 */
$app->router->post("dice/play", function () use ($app) {
    $game = $_SESSION["diceGame"];
    $save = $_POST["save"] ?? null;
    $doit = $_POST["doit"] ?? null;
    $reset = $_POST["reset"] ?? null;
    $next = $_POST["next"] ?? null;
    $computer = $_POST["computer"] ?? null;

    $_SESSION["doit"] = $doit;
    $_SESSION["save"] = $save;

    // var_dump($_SESSION);
    if ($reset) {
        return $app->response->redirect("dice/init");
    } elseif ($game->checkWinner()) {
        return $app->response->redirect("dice/playwin");
    } elseif ($save) {
        $game->saveTotalScore();
        if ($game->checkWinner()) {
            return $app->response->redirect("dice/playwin");
        } else {
            $game->nextPlayer();
            return $app->response->redirect("dice/play");
        }
    } elseif ($next) {
        $game->nextPlayer();
        return $app->response->redirect("dice/play");
    } elseif ($computer) {
        $game->nextPlayer();
        $game->roll();
        return $app->response->redirect("dice/play");
    } elseif ($doit) {
        $game->roll();
        return $app->response->redirect("dice/play");
    }
});


/**
 * Redirect to page if player wins the game.
 */
$app->router->get("dice/playwin", function () use ($app) {
    $title = "Win or loose";

    $game = $_SESSION["diceGame"] ?? null;
    $score = $game->getTotalScore();
    $players = $game->getPlayers();

    $data = [
        "game" => $game,
        "score" => $score,
        "players" => $players,
    ];

    $app->page->add("dice/playwin", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
