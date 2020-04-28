<?php

namespace Bjos\Dice;

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
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";

        // Use $this->app to access the framework services.
    }



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
     * @return string
     */
    public function initActionPost() : string
    {
        // init the session for the game;
        $name = $_POST["name"];
        $dices = $_POST["dices"];

        $diceGame = new DiceGame($name, $dices);
        $_SESSION["diceGame"] = $diceGame;

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

        $game = $_SESSION["diceGame"] ?? null;
        $score = $game->getTotalScore();
        $players = $game->getPlayers();

        $data = [
            "game" => $game,
            "score" => $score,
            "players" => $players,
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
     * @return string
     */
    public function playActionPost() : string
    {
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
        } elseif ($doit) {
            $game->roll();
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
        $game = $_SESSION["diceGame"] ?? null;

        $game->saveTotalScore();
        if ($game->checkWinner()) {
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

        $game = $_SESSION["diceGame"] ?? null;
        $score = $game->getTotalScore();
        $players = $game->getPlayers();

        $data = [
            "game" => $game,
            "score" => $score,
            "players" => $players,
        ];

        $this->app->page->add("dice100/playwin", $data);
        // $this->app->page->add("dice100/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
