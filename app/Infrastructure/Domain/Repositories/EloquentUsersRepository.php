<?php

namespace App\Infrastructure\Domain\Repositories;

use App\Domain\Repositories\UsersRepository;
use App\Infrastructure\Domain\Models\EloquentUser;

class EloquentUsersRepository implements UsersRepository
{
    /**
     * @var EloquentUser
     */
    protected $model;

    /**
     * @param EloquentUser $user
     */
    public function __construct(EloquentUser $user)
    {
        $this->model = $user;
    }

    /**
     * @param $id
     * @return EloquentUser
     */
    public function get($id)
    {
        $model = $this->model;
        return $model::find($id);
    }

    /**
     * @param $options
     *
     * @return EloquentUser[]
     */
    public function getList(array $options = [])
    {
        $model = $this->model;
        return $model::all();
    }

    /**
     * @param $id
     * @param array $data
     * @return EloquentUser
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
     * @return EloquentUser
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
     * @return EloquentUser
     */
    public function createEntity()
    {
        return new $this->model;
    }


}