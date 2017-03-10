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
        if (is_null($id)) {
            /** @var User $model */
            $model = $this->repo->create(User::passwordHash($data));
        } else {
            /** @var User $model */
            $model = $this->repo->update($id, User::passwordHash($data));
        }

        return $model;
    }

}