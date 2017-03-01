<?php

namespace App\Repositories;

use App\Models\Model;

abstract class Repository implements RepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @param $id
     * @return Model
     */
    public function get($id)
    {
        $model = $this->model;
        return $model::find($id);
    }

    /**
     * @return Model[]
     */
    public function getList()
    {
        $model = $this->model;
        return $model::all();
    }

    /**
     * @param $id
     * @param array $data
     * @return Model
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
     * @return Model
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
}