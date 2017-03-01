<?php

use App\Services\UsersService;
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

    public function testGet()
    {
        $this->assertEquals((bool)$this->service->get(1), true);
        $this->assertEquals((bool)$this->service->get(3), false);
    }

    public function testList()
    {
        $this->assertEquals(count($this->service->getList()), 2);
    }

    public function testCreateEntity()
    {
        $model = $this->service->createEntity();
        $this->assertEquals($model->id, null);
        $this->assertEquals($model instanceof \App\Models\User, true);
    }

    public function testSaveDelete()
    {
        $this->assertEquals($this->service->save([]), false);
        $this->assertEquals((bool)$this->service->getErrors(), true);
    }
}