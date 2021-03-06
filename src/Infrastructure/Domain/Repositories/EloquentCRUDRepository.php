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
        }

        return null;
    }

    /**
     * @param array $options
     * @return int
     */
    public function countList(array $options)
    {
        $eloquent = $this->eloquent;
        return $eloquent::condition($options)->count();
    }

    /**
     * @param $options
     *
     * @return EloquentModel[]
     */
    public function getList(array $options = [])
    {
        $eloquent = $this->eloquent;
        $builder = $eloquent::condition($options);

        if (isset($options['limit']) && isset($options['page'])) {
            $builder = $eloquent->scopePaginate($builder, $options['limit'], $options['limit'] * ($options['page'] - 1));
        }

        return $this->toDomains($builder);
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
        $eloquent = clone $this->eloquent;

        foreach ($data as $key => $val) {
            $eloquent->{$key} = $val;
        }

        return ($eloquent->save()) ?  $eloquent->toDomain() : null;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $eloquent = $this->eloquent;

        if ($model = $eloquent::find($id)) {
            return $model->forceDelete();
        }

        return true;
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

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return array
     */
    protected function toDomains(\Illuminate\Database\Eloquent\Builder $builder)
    {
        if ($result = $builder->get()) {
            $list = [];
            /** @var EloquentModel $item */
            foreach ($result as $item) {
                $list[] = $item->toDomain();
            }

            return $list;
        }

        return [];
    }

}
