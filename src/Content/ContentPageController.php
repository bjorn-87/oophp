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
class ContentPageController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $contentPage;

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
        $this->contentPage = new ContentPage($this->app->db);

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
        $title = "Pages";

        $res = $this->contentPage->showAllPages();

        $this->app->page->add("content/header");
        $this->app->page->add("content/pages", [
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
    public function pageActionGet($path=null) : object
    {
        $title = "Page";

        // var_dump($path);

        $content = $this->contentPage->showPage($path);
        $error = $content->error ?? null;

        $this->app->page->add("content/header");
        if ($content) {
            $this->app->page->add("content/page", [
                "content" => $content,
                "error" => $error,
            ]);
        } else {
            $this->app->page->add("content/404");
        }

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
