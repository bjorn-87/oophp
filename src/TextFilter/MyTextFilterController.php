<?php

namespace Bjos\TextFilter;

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
class MyTextFilterController implements AppInjectableInterface
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
        return $this->app->response->redirect("textfilter/bbcode");
    }



    /**
     * Shows bbcode
     *
     * @return object
     */
    public function bbcodeActionGet() : object
    {
        $title = "Bbcode";
        $text = file_get_contents(ANAX_INSTALL_PATH . "/htdocs/text/bbcode.txt");
        $textFilter = new MyTextFilter();

        $htmlBbcode = $textFilter->parse($text, ["bbcode", "esc"]);
        $bbcodeNl2br = $textFilter->parse($text, ["bbcode", "nl2br"]);

        $this->app->page->add("textfilter/navbar");
        $this->app->page->add("textfilter/bbcode", [
            "htmlBbcode" => $htmlBbcode,
            "bbcodeNl2br" => $bbcodeNl2br,
            "text" => $text,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * Shows clickable
     *
     * @return object
     */
    public function clickableActionGet() : object
    {
        $title = "Clickable";
        $text = file_get_contents(ANAX_INSTALL_PATH . "/htdocs/text/clickable.txt");
        $textFilter = new MyTextFilter();

        $htmlText = $textFilter->parse($text, ["esc"]);
        $htmlClickable = $textFilter->parse($text, ["link", "esc"]);
        $clickable = $textFilter->parse($text, ["link"]);

        $this->app->page->add("textfilter/navbar");
        $this->app->page->add("textfilter/clickable", [
            "htmlText" => $htmlText,
            "htmlClickable" => $htmlClickable,
            "clickable" => $clickable,
            "text" => $text,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    /**
     * Shows markdown
     *
     * @return object
     */
    public function markdownActionGet() : object
    {
        $title = "Clickable";
        $text = file_get_contents(ANAX_INSTALL_PATH . "/htdocs/text/sample.md");
        $textFilter = new MyTextFilter();

        $htmlMarkdown = $textFilter->parse($text, ["markdown", "esc"]);
        $markDown = $textFilter->parse($text, ["markdown"]);

        $this->app->page->add("textfilter/navbar");
        $this->app->page->add("textfilter/markdown", [
            "htmlMarkdown" => $htmlMarkdown,
            "markDown" => $markDown,
            "text" => $text,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
