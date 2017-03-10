<?php

namespace App\Services;

interface AuthService
{

    /**
     * @param $mail
     * @param $password
     * @return null
     */
    public function login($mail, $password);
}