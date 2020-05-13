<?php

namespace Bjos\Content;

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
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $content;

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
        $this->content = new Content($this->app->db);

        // Use $this->app to access the framework services.
    }


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
        $title = "CMS";

        $this->app->page->add("content/header");
        $this->app->page->add("content/index");

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
        $title = "CMS Show all";

        $res = $this->content->showAllContent();

        $this->app->page->add("content/header");
        $this->app->page->add("content/show-all", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * Reset the database to default GET.
     *
     * @return object
     */
    public function resetActionGet() : object
    {
        $title = "reset";
        $output = $this->app->session->getOnce("output");

        $this->app->page->add("content/header");
        $this->app->page->add("content/reset", [
            "output" => $output,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * Reset the database to default POST.
     *
     * @return
     */
    public function resetActionPost()
    {
        $request = $this->app->request;

        // Restore the database to its original settings
        $file   = ANAX_INSTALL_PATH . "/sql/content/setup.sql";
        $output = null;
        $reset = $request->getPost("reset");
        $res = "";
        $databaseConfig = $this->app->configuration->load("database")["config"];

        if ($_SERVER["SERVER_NAME"] === "www.student.bth.se") {
            $mysql  = "/usr/bin/mysql";
        } else {
            $mysql = "mysql";
        }

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
                // $res = "<p>Databasen är återställd</p>";
                $res = "The command exit status was $status."
                    . "<br>The output from the command was:</p><pre>"
                    . print_r($output, 1);
            } else {
                $res = "<p>Något gick fel, databasen är ej återställd</p>";
            }
            $output = "The command exit status was $status."
                . "<br>The output from the command was:</p><pre>"
                . print_r($output, 1);
            $this->app->session->set("output", $res);
            return $this->app->response->redirect("content/reset");
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
    public function adminActionGet() : object
    {
        $title = "Admin";
        $resultset = $this->content->showAllContent();

        $this->app->page->add("content/header");
        $this->app->page->add("content/admin", [
            "resultset" => $resultset,
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
    public function createActionGet() : object
    {
        $title = "Create";

        $this->app->page->add("content/header");
        $this->app->page->add("content/create");

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
    public function createActionPost() : object
    {
        $request = $this->app->request;

        $title = $request->getPost("doCreate");

        $contentId = $this->content->createContent($title);
        $this->app->session->set("contentId", $contentId);
        return $this->app->response->redirect("content/edit");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function editActionGet() : object
    {
        $request = $this->app->request;
        $session = $this->app->session;

        $max = $this->content->countContent();
        $contentId = $session->getOnce("contentId") ?: $request->getGet("id");
        // var_dump($max);
        // var_dump($contentId);
        // var_dump($contentId > $max->max);

        $title = "Edit content";

        if ((!is_numeric($contentId) || intval($contentId) > $max->max)) {
            return $this->app->response->redirect("content/admin");
        }

        $content = $this->content->getContentById($contentId);

        $this->app->page->add("content/header");
        $this->app->page->add("content/edit", [
            "content" => $content
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
    public function editActionPost()
    {
        $request = $this->app->request;

        $contentId = $request->getPost("contentId") ?: getGet("id");
        $this->app->session->set("contentId", $contentId);

        if (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("content/delete");
        } elseif (hasKeyPost("doSave")) {
            $params = getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId"
            ]);

            // var_dump($params);
            if (!$params["contentSlug"]) {
                $params["contentSlug"] = slugify($params["contentTitle"]);
            }

            if (!$params["contentPath"]) {
                $params["contentPath"] = null;
            }
            $this->content->editContent($params);
        }
        return $this->app->response->redirect("content/edit");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function deleteActionGet() : object
    {
        $request = $this->app->request;
        $session = $this->app->session;

        $max = $this->content->countContent();
        $contentId = $session->getOnce("contentId") ?: $request->getGet("id");


        $title = "Delete content";

        if ((!is_numeric($contentId) || intval($contentId) > $max->max)) {
            return $this->app->response->redirect("content/admin");
        }

        $content = $this->content->getContentById($contentId);

        $this->app->page->add("content/header");
        $this->app->page->add("content/delete", [
            "content" => $content
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
