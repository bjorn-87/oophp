<?php

namespace Bjos\Movie;

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
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $title = "Movie database";
        // Deal with the action and return a response.

        $this->app->page->add("movie/index");

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
    public function showAllActionGet() : object
    {
        $title = "Show all";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/show-all", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
