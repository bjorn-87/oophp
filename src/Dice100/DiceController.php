<?php

namespace Bjos\Dice100;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function initActionGet() : object
    {
        $title = "init";

        $this->app->page->add("dice100/init");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function initActionPost() : object
    {
        // init the session for the game;
        $request = $this->app->request;

        $name = $request->getPost("name", "Player");
        $dices = $request->getPost("dices", 3);

        $diceGame = new DiceGame($name, $dices);

        $this->app->session->set("diceGame", $diceGame);

        return $this->app->response->redirect("dice100/play");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function playActionGet() : object
    {
        $title = "Play the game";

        $game = $this->app->session->get("diceGame");

        $score = $game->getTotalScore();
        $players = $game->getPlayers();
        $playerName = $game->getCurrentPlayerName();
        $checkGame = $game->checkGame();
        $currentPlayer = $game->getCurrentPlayer();
        $dices = $game->getValues();
        $histogram = $game->getHistogram();
        $sum = $game->getSum();
        $currentScore = $game->getCurrentScore();
        $rollCount = $game->getRollCount();
        $checkOne = $game->checkOne();

        $data = [
            "sum" => $sum,
            "dices" => $dices,
            "score" => $score,
            "players" => $players,
            "checkOne" => $checkOne,
            "rollCount" => $rollCount,
            "checkGame" => $checkGame,
            "playerName" => $playerName,
            "currentScore" => $currentScore,
            "currentPlayer" => $currentPlayer,
            "histogram" => $histogram
        ];

        $this->app->page->add("dice100/play", $data);
        // $app->page->add("dice100/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function playActionPost() : object
    {
        $request = $this->app->request;

        $game = $this->app->session->get("diceGame");
        $save = $request->getPost("save");
        $doIt = $request->getPost("doIt");
        $reset = $request->getPost("reset");
        $next = $request->getPost("next");
        $computer = $request->getPost("computer");

        if ($reset) {
            return $this->app->response->redirect("dice100/init");
        } elseif ($game->checkWinner()) {
            return $this->app->response->redirect("dice100/playwin");
        } elseif ($save) {
            return $this->app->response->redirect("dice100/save");
        } elseif ($next) {
            $game->nextPlayer();
            return $this->app->response->redirect("dice100/play");
        } elseif ($computer) {
            $game->nextPlayer();
            $game->roll();
            return $this->app->response->redirect("dice100/play");
        } elseif ($doIt) {
            $game->roll();
            return $this->app->response->redirect("dice100/play");
        } else {
            return $this->app->response->redirect("dice100/play");
        }
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function saveAction() : object
    {
        $game = $this->app->session->get("diceGame");
        $game->saveTotalScore();
        $winner = $game->checkWinner();

        if ($winner) {
            return $this->app->response->redirect("dice100/playwin");
        } else {
            $game->nextPlayer();
            return $this->app->response->redirect("dice100/play");
        }
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function playwinAction() : object
    {
        $title = "Win or loose";

        $game = $this->app->session->get("diceGame");
        $score = $game->getTotalScore();
        $players = $game->getPlayers();
        $playerName = $game->getCurrentPlayerName();
        $histogram = $game->getHistogram();

        $data = [
            "score" => $score,
            "players" => $players,
            "playerName" => $playerName,
            "histogram" => $histogram
        ];

        $this->app->page->add("dice100/playwin", $data);
        // $this->app->page->add("dice100/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
