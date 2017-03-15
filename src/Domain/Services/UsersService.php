<?php

namespace Domain\Services;

use Domain\Repositories\UsersRepository;
use Domain\Models\User;
use Infrastructure\Domain\Services\CRUDService;

class UsersService extends Service implements \App\Services\UsersService
{
    use CRUDService;

    /**
     * @var UsersRepository
     */
    protected $repo;

    /**
     * UsersService constructor.
     * @param UsersRepository $repo
     */
    public function __construct(UsersRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $data
     * @param $id
     * @return User
     */
    public function save(array $data, $id = null)
    {
        $data = User::passwordHash($data);
        return (is_null($id)) ? $this->repo->create($data) : $this->repo->update($id, $data);
    }

}