<?php

namespace App\Services;

use App\Repositories\UsersRepository;

class UsersService extends Service
{

    /**
     * @var array
     */
    protected $rules = [
        "login_id" => "required|max:100",
        "password" => "required|max:100",
        "mail" => "required|max:255"
    ];

    /**
     * UsersService constructor.
     * @param UsersRepository $repo
     */
    public function __construct(UsersRepository $repo)
    {
        $this->repo = $repo;
    }
}