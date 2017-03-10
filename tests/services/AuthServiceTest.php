<?php

use App\Services\AuthService;
use Illuminate\Support\Facades\Artisan;

class AuthServiceTest extends TestCase
{

    /**
     * @var AuthService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $this->service = $this->app->make(AuthService::class);
    }

    public function testLogin()
    {
        $this->assertEquals($this->service->login('test', 'password'), null);
        $this->assertEquals($this->service->login('mail.sumimaru+1@gmail.com', 'pass'), null);
        $this->assertEquals($this->service->login('mail.sumimaru+1@gmail.com', 'password'), 1);
    }

}