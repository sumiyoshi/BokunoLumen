<?php

namespace App\Domain\Services;

use App\Domain\Repositories\UsersRepository;
use App\Domain\Models\User;


class UsersService extends Service
{

    /**
     * @var UsersRepository
     */
    protected $repo;

    /**
     * @var array
     */
    protected $rules = [
        "name" => "required|max:100",
        "login_id" => "required|max:100",
        "password" => "required|max:100",
        "mail" => "required|max:255"
    ];

    /**
     * UsersService constructor.
     * @param UsersRepository $repo
     */
    public function __construct(UsersRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $id
     * @return User
     */
    public function get($id)
    {
        return $this->repo->get($id);
    }

    /**
     * @param $options
     *
     * @return User[]
     */
    public function getList(array $options = [])
    {
        return $this->repo->getList($options);
    }

    /**
     * @param $data
     * @param $id
     * @return User
     */
    public function save(array $data, $id = null)
    {
        $factory = $this->validationFactory();

        $v = $factory->make($data, $this->rules);
        if ($v->fails()) {
            $this->errors = $v->messages()->toArray();
            return false;
        }

        if (is_null($id)) {
            /** @var User $model */
            $model = $this->repo->create(User::passwordHash($data));
        } else {
            /** @var User $model */
            $model = $this->repo->update($id, User::passwordHash($data));
        }

        return $model;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        if ($this->repo->delete($id) === 1) {
            return true;
        }

        return false;
    }

    /**
     * @return User
     */
    public function createEntity()
    {
        return $this->repo->createEntity();
    }
}