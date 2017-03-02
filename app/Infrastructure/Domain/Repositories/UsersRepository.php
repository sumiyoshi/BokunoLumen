<?php

namespace App\Infrastructure\Domain\Repositories;

use App\Domain\Repositories\UsersRepositoryInterface;
use App\Models\User;

class UsersRepository implements UsersRepositoryInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param $id
     * @return User
     */
    public function get($id)
    {
        $model = $this->model;
        return $model::find($id);
    }

    /**
     * @param $options
     *
     * @return User[]
     */
    public function getList(array $options = [])
    {
        $model = $this->model;
        return $model::all();
    }

    /**
     * @param $id
     * @param array $data
     * @return User
     */
    public function update($id, array $data)
    {
        if ($model = $this->get($id)) {

            foreach ($data as $key => $val) {
                $model->{$key} = $val;
            }

            if ($model->save()) {
                return $model;
            }
        }

        return false;
    }

    /**
     * @param $data
     * @return User
     */
    public function create(array $data)
    {
        $model = $this->model;
        return $model::create($data);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $model = $this->model;
        return $model::destroy($id);
    }

    /**
     * @return User
     */
    public function createEntity()
    {
        return new $this->model;
    }

   
}