<?php

use App\Domain\Services\UsersService;
use Illuminate\Support\Facades\Artisan;

class UsersServiceTest extends TestCase
{

    /**
     * @var UsersService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $this->service = $this->app->make(UsersService::class);
    }

    public function testCreateEntity()
    {
        $model = $this->service->createEntity();
        $this->assertEquals($model->id, null);
        $this->assertEquals($model instanceof \App\Domain\Models\User, true);
    }

}