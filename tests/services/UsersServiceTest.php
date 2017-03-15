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
        $users = $this->service->get(2);
        $this->assertEquals($users->name, 'TestUser2');
    }

    public function testGetList()
    {
        $users = $this->service->getList([]);
        $this->assertEquals(count($users), 2);
    }

    public function testCreateEntity()
    {
        $model = $this->service->createEntity();
        $this->assertEquals($model->id, null);
        $this->assertEquals($model instanceof \Domain\Models\User, true);
    }

    public function testSaveAndDelete()
    {
        $data = [
            'name' => 'TestUser3',
            'mail' => 'mail.sumimaru@gmail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ];
        $user = $this->service->save($data);

        $this->assertEquals((bool)$user->id, true);

        $data['name'] = 'update';
        $user = $this->service->save($data, $user->id);
        $this->assertEquals($user->name, 'update');

        $this->assertEquals($this->service->delete($user->id), true);
    }
}