<?php

use App\Http\Controllers\UsersController;

class UsersRequestTest extends TestCase
{
    /**
     * @var UsersController
     */
    protected $controller;

    public function setUp()
    {
        parent::setUp();

        $this->controller = $this->app->make(UsersController::class);
    }

    public function testRequest()
    {
        $this->assertEquals((bool)$this->controller->requestValidation([], $this->controller->getRules()), true);
    }

}