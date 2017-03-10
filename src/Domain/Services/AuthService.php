<?php

namespace Domain\Services;

use Domain\Repositories\UsersRepository;

class AuthService extends Service implements \App\Services\AuthService
{

    /**
     * @var UsersRepository
     */
    protected $repo;

    /**
     * UsersService constructor.
     * @param UsersRepository $repo
     */
    public function __construct(UsersRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param $mail
     * @param $password
     * @return null
     */
    public function login($mail, $password)
    {
        $model = $this->repo->getByMail($mail);

        if (!$model) {
            return null;
        }

        return ($model->passwordEqual($password)) ? $model->id : null;
    }

}