<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UsersRepository;

class UsersService extends Service
{

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
}