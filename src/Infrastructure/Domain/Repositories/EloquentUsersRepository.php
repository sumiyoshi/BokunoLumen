<?php

namespace Infrastructure\Domain\Repositories;

use Domain\Models\User;
use Domain\Repositories\UsersRepository;
use Infrastructure\Domain\Models\EloquentUser;

class EloquentUsersRepository implements UsersRepository
{
    use EloquentCRUDRepository;

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
     * @param $mail
     * @return User
     */
    public function getByMail($mail)
    {
        $eloquent = $this->eloquent;

        /** @var EloquentUser $result */
        if ($result = $eloquent::where('mail', $mail)->first()) {
            return $result->toDomain();
        }

        return null;
    }

}