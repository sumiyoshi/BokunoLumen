<?php

namespace App\Infrastructure\Domain\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\UsersRepository;
use App\Infrastructure\Domain\Models\EloquentUser;

class EloquentUsersRepository implements UsersRepository
{
    /**
     * @var EloquentUser
     */
    protected $eloquent;

    /**
     * @param EloquentUser $user
     */
    public function __construct(EloquentUser $user)
    {
        $this->eloquent = $user;
    }

    /**
     * @param $id
     * @return User
     */
    public function get($id)
    {
        $eloquent = $this->eloquent;
        /** @var EloquentUser $result */
        if ($result = $eloquent::find($id)) {
            return $result->toDomain();
        } else {
            return null;
        }
    }


    /**
     * @param $mail
     * @return User
     */
    public function getByMail($mail)
    {
        $eloquent = $this->eloquent;

        /** @var EloquentUser $result */
        if ($result = $eloquent::where('mail', $mail)->first()) {
            return $result->toDomain();
        } else {
            return null;
        }
    }

    /**
     * @param $options
     *
     * @return User[]
     */
    public function getList(array $options = [])
    {
        $eloquent = $this->eloquent;;

        if ($result = $eloquent::all()) {
            $list = [];
            /** @var EloquentUser $item */
            foreach ($result as $item) {
                $list[] = $item->toDomain();
            }

            return $list;
        } else {
            return [];
        }
    }

    /**
     * @param $id
     * @param array $data
     * @return User
     */
    public function update($id, array $data)
    {
        $eloquent = $this->eloquent;

        /** @var EloquentUser $model */
        if ($model = $eloquent::find($id)) {

            foreach ($data as $key => $val) {
                $model->{$key} = $val;
            }

            if ($model->save()) {
                return $model->toDomain();
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
        $eloquent = $this->eloquent;

        /** @var EloquentUser $model */
        if ($model = $eloquent::create($data)) {
            return $model->toDomain();
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $eloquent = $this->eloquent;
        return $eloquent::destroy($id);
    }

    /**
     * @return User
     */
    public function createEntity()
    {
        /** @var EloquentUser $model */
        $model = new $this->eloquent;
        return $model->toDomain();
    }

}