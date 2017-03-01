<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends Repository
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

   
}