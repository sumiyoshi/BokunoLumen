<?php

namespace App\Services;

use Domain\Models\User;

interface UsersService
{
    /**
     * @param $id
     * @return User
     */
    public function get($id);

    /**
     * @param $options
     *
     * @return User[]
     */
    public function getList(array $options = []);

    /**
     * @param $id
     * @return bool
     */
    public function delete($id);

    /**
     * @return User
     */
    public function createEntity();

    /**
     * @param $data
     * @param $id
     * @return User
     */
    public function save(array $data, $id = null);
}