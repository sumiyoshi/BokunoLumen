<?php

namespace Domain\Repositories;

use Domain\Models\User;

interface UsersRepository
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
    public function getList(array $options);

    /**
     * @param $mail
     * @return User
     */
    public function getByMail($mail);

    /**
     * @param $id
     * @param array $data
     * @return User
     */
    public function update($id, array $data);

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data);

    /**
     * @param $id
     * @return bool
     */
    public function delete($id);

    /**
     * @return User
     */
    public function createEntity();
}