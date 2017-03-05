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

        list($res, $data) = $this->controller->requestValidation([], $this->controller->getRules());
        $this->assertEquals($res, false);

        list($res, $data) = $this->controller->requestValidation([
            "name" => "name",
            "password" => "password",
            "mail" => 'mail'
        ], $this->controller->getRules());
        $this->assertEquals($res, true);
    }

}