<?php

namespace App\Domain\Models;

class User extends Model
{

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $mail;

    /**
     * @var string
     */
    public $name;

    /**
     * @return array
     */
    public static function passwordHash($data)
    {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    /**
     * @param $pass
     * @return bool
     */
    public function passwordEqual($pass)
    {
        return password_verify($pass, $this->password);
    }


}
