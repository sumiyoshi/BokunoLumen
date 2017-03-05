<?php

namespace Infrastructure\Domain\Repositories;

use Infrastructure\Domain\Models\EloquentModel;

/**
 * @property EloquentModel $eloquent
 */
trait EloquentCRUDRepository
{

    /**
     * @param $id
     * @return EloquentModel
     */
    public function get($id)
    {
        $eloquent = $this->eloquent;
        /** @var EloquentModel $result */
        if ($result = $eloquent::find($id)) {
            return $result->toDomain();
        } else {
            return null;
        }
    }

    /**
     * @param $options
     *
     * @return EloquentModel[]
     */
    public function getList(array $options = [])
    {
        $eloquent = $this->eloquent;;

        if ($result = $eloquent::condition($options)->get()) {
            $list = [];
            /** @var EloquentModel $item */
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
     * @return EloquentModel
     */
    public function update($id, array $data)
    {
        $eloquent = $this->eloquent;

        /** @var EloquentModel $model */
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
     * @return EloquentModel
     */
    public function create(array $data)
    {
        $eloquent = $this->eloquent;

        foreach ($data as $key => $val) {
            $eloquent->{$key} = $val;
        }

        if ($eloquent->save()) {
            return $eloquent->toDomain();
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
     * @return EloquentModel
     */
    public function createEntity()
    {
        /** @var EloquentModel $model */
        $model = new $this->eloquent;
        return $model->toDomain();
    }

}