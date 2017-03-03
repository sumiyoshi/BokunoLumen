<?php

namespace Infrastructure\Domain\Services;

/**
 * @property mixed $repo
 */
trait CRUDService
{

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->repo->get($id);
    }

    /**
     * @param $options
     *
     * @return array
     */
    public function getList(array $options = [])
    {
        return $this->repo->getList($options);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function save(array $data, $id = null)
    {
        return (is_null($id)) ? $this->repo->create($data) : $this->repo->update($id, $data);
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
     * @return mixed
     */
    public function createEntity()
    {
        return $this->repo->createEntity();
    }
}