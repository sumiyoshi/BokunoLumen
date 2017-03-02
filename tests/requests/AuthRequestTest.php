<?php

use App\Http\Controllers\AuthController;

class AuthRequestTest extends TestCase
{

    /**
     * @var AuthController
     */
    protected $controller;

    public function setUp()
    {
        parent::setUp();

        $this->controller = $this->app->make(AuthController::class);
    }

    public function testRequest()
    {
        $this->assertEquals((bool)$this->controller->requestValidation([], $this->controller->getRules()), true);
    }

}