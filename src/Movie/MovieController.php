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

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $title = "reset";
        $output = $this->app->session->getOnce("output");
        $db = $this->app;
        $dbConf = $this->app->configuration->load("database");

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/reset", [
            "output" => $output,
            "db" => $db,
            "dbConf" => $dbConf,
        ]);

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
     * @return
     */
    public function resetActionPost()
    {
        $request = $this->app->request;

        // Restore the database to its original settings
        $file   = ANAX_INSTALL_PATH . "/sql/movie/setup.sql";
        $mysql  = "mysql";
        $output = null;
        $reset = $request->getPost("reset");
        $res = "";
        $databaseConfig = $this->app->configuration->load("database")["config"];

        // Extract hostname and databasename from dsn
        $dsnDetail = [];
        preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $databaseConfig["dsn"], $dsnDetail);
        $host = $dsnDetail[1];
        $database = $dsnDetail[2];
        $login = $databaseConfig["username"];
        $password = $databaseConfig["password"];

        if (isset($reset)) {
            $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
            $output = [];
            $status = null;
            exec($command, $output, $status);
            if ($status === 0) {
                $res = "<p>Databasen är återställd</p>";
            } else {
                $res = "<p>Något gick fel, databasen är ej återställd</p>";
            }
            // $output = "The command exit status was $status."
            //     . "<br>The output from the command was:</p><pre>"
            //     . print_r($output, 1);
            $this->app->session->set("output", $res);
            return $this->app->response->redirect("movie/reset");
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
    public function movieSelectActionGet() : object
    {
        $title = "Select";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $movies = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/movie-select", [
            "movies" => $movies,
        ]);

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
    public function movieSelectActionPost() : object
    {
        $request = $this->app->request;
        $db = $this->app->db;

        $db->connect();

        $movieId = $request->getPost("movieId");
        $doEdit = $request->getPost("doEdit");
        $doDelete = $request->getPost("doDelete");
        $doAdd = $request->getPost("doAdd");

        // var_dump($_POST);

        if (isset($doEdit) && is_numeric($movieId)) {
            $this->app->session->set("movieId", $movieId);
            return $this->app->response->redirect("movie/movie-edit");
        } elseif (isset($doDelete)) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $db->execute($sql, [$movieId]);

            return $this->app->response->redirect("movie/movie-select");
        } elseif (isset($doAdd)) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $db->execute($sql, ["A title", 2017, "img/noimage.png"]);
            $movieId = $db->lastInsertId();
            $this->app->session->set("movieId", $movieId);

            return $this->app->response->redirect("movie/movie-edit");
        }
        return $this->app->response->redirect("movie/movie-select");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function movieEditActionGet() : object
    {
        $title = "Update movie";

        $this->app->db->connect();
        $movieId = $this->app->session->get("movieId");

        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $this->app->db->executeFetchAll($sql, [$movieId]);
        $movie = $movie[0];

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/movie-edit", [
            "movie" => $movie,
        ]);

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
    public function movieEditActionPost() : object
    {
        $request = $this->app->request;
        $db = $this->app->db;

        $this->app->db->connect();

        $doSave = $request->getPost("doSave");
        $movieId = $request->getPost("movieId");
        $movieTitle = $request->getPost("movieTitle");
        $movieYear = $request->getPost("movieYear");
        $movieImage = $request->getPost("movieImage");

        if (isset($doSave)) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);

            return $this->app->response->redirect("movie/movie-edit");
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
    public function searchTitleActionGet() : object
    {
        $request = $this->app->request;

        $title = "Search title";
        $resultset = null;

        $this->app->db->connect();
        $searchTitle = $request->getGet("searchTitle");
        // var_dump($searchTitle);

        if (isset($searchTitle)) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        }

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/search-title", [
            "searchTitle" => $searchTitle,
        ]);
        $this->app->page->add("movie/show-all", [
            "resultset" => $resultset
        ]);

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
    public function searchYearActionGet() : object
    {
        $request = $this->app->request;

        $title = "Search year";
        $resultset = null;

        $this->app->db->connect();

        $year1 = $request->getGet("year1");
        $year2 = $request->getGet("year2");
        // var_dump($year1);
        // var_dump($year2);

        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
        }

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/search-year", [
            "year1" => $year1,
            "year2" => $year2,
        ]);
        $this->app->page->add("movie/show-all", [
            "resultset" => $resultset
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
