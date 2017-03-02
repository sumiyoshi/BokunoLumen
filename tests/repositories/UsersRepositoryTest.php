<?php

use App\Domain\Repositories\UsersRepository;
use Illuminate\Support\Facades\Artisan;

class UsersRepositoryTest extends TestCase
{
    /**
     * @var UsersRepository
     */
    protected $repo;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $this->repo = $this->app->make(UsersRepository::class);
    }

    public function testGet()
    {
        /** @var App\Domain\Models\User $user */
        $user = $this->repo->get(2);
        $this->assertEquals($user->name, 'TestUser2');
        $this->assertEquals($user->login_id, 'admin2');
    }

    public function testList()
    {
        $users = $this->repo->getList([]);
        $this->assertEquals(count($users), 2);
    }

    public function testCreateUpdateDelete()
    {
        $user = $this->repo->create([
            'name' => 'TestUser3',
            'login_id' => 'admin3',
            'mail' => 'sumiyoshi102@gmail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ]);

        $this->assertEquals($user->name, 'TestUser3');
        $this->assertEquals($user->login_id, 'admin3');
        $this->assertEquals($user->mail, 'sumiyoshi102@gmail.com');

        $user = $this->repo->update($user->id, ['name' => 'update']);
        $this->assertEquals($user->name, 'update');

        $id = $user->id;

        $this->assertEquals($this->repo->delete($id), 1);
        $this->assertEquals($this->repo->get($id), NULL);
    }
}