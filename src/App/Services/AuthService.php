<?php

namespace App\Services;

interface AuthService
{

    /**
     * @param $mail
     * @param $password
     * @return null|int
     */
    public function login($mail, $password);
}