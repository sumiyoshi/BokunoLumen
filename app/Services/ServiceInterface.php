<?php

namespace App\Services;

use App\Models\Model;

interface ServiceInterface
{
    /**
     * @return Model
     */
    public function get($id);

    /**
     * @param $options
     *
     * @return array
     */
    public function getList(array $options = []);

    /**
     * @param array $data
     * @param $id | null
     * @return Model
     */
    public function save(array $data, $id = null);

    /**
     * @param $id
     * @return int
     */
    public function delete($id);

    /**
     * @return Model
     */
    public function createEntity();

    /**
     * @return array
     */
    public function getErrors();
}