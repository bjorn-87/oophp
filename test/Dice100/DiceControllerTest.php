<?php

namespace Bjos\Dice100;

use Anax\DI\DIMagic;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the controller like it would be used from the router,
 * simulating the actual router paths and calling it directly.
 */
class DiceControllerTest extends TestCase
{
    private $controller;
    private $app;


    /**
     * Setup the controller, before each testcase, just like the router
     * would set it up.
     */
    protected function setUp(): void
    {
        global $di;
        // Init service container $di to contain $app as a service
        $di = new DIMagic();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $app = $di;
        $this->app = $app;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new DiceController();
        $this->controller->setApp($app);
        // $this->controller->initialize();
    }



    /**
     * Call the controller index action.
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertIsString($res);
        $this->assertContains("Index", $res);
    }

    /**
     * Call the controller index action.
     */
    public function testInitActionPostAndPlayActionGet()
    {
        $res = $this->controller->initActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $res2 = $this->controller->playActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res2);
    }


    /**
     * Call the controller index action.
     */
    public function testInitActionGetAndSaveAction()
    {
        $res = $this->controller->initActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $res2 = $this->controller->saveAction();
        $this->assertInstanceOf(ResponseUtility::class, $res2);
    }

    /**
     * Call the controller index action.
     */
    public function testSaveActionWin()
    {
        $game = new DiceGame("player", 2, 2, 0);
        $this->app->session->set("diceGame", $game);
        $res = $this->controller->saveAction();
        // $this->app->session->set("diceGame", null);
        $this->assertInstanceOf(ResponseUtility::class, $res);
        // $this->assertContains("Index", $res);
    }


    /**
     * Call the controller index action.
     */
    public function testPlayWinActionAndPlayActionPost()
    {
        $res = $this->controller->playwinAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $res2 = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res2);
    }

    /**
     * Call the controller playActionPost.
     */
    public function testPlayActionPostCheckWin()
    {
        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller playActionPost.
     * First no args.
     * Then reset.
     * Then save.
     * Then next.
     */
    public function testPlayActionPost()
    {
        $game = new DiceGame();
        $this->app->session->set("diceGame", $game);

        $res = $this->controller->playActionPost();
        $this->assertInstanceOf(ResponseUtility::class, $res);

        $this->app->request->setPost("reset", true);
        $res1 = $this->controller->playActionPost();
        $this->app->request->setPost("reset", false);
        $this->assertInstanceOf(ResponseUtility::class, $res1);

        $this->app->request->setPost("save", true);
        $res2 = $this->controller->playActionPost();
        $this->app->request->setPost("save", false);
        $this->assertInstanceOf(ResponseUtility::class, $res2);

        $this->app->request->setPost("next", true);
        $res3 = $this->controller->playActionPost();
        $this->app->request->setPost("next", false);
        $this->assertInstanceOf(ResponseUtility::class, $res3);
    }


    /**
     * Call the controller playActionPost.
     */
    public function testPlayActionPostCheckComputer()
    {
        $this->app->request->setPost("computer", true);
        $res = $this->controller->playActionPost();
        $this->app->request->setPost("computer", false);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }


    /**
     * Call the controller playActionPost.
     */
    public function testPlayActionPostCheckRoll()
    {
        $this->app->request->setPost("doIt", true);
        $res = $this->controller->playActionPost();
        $this->app->request->setPost("doIt", false);
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
