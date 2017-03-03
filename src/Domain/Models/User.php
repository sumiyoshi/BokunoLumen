<?php

namespace Domain\Models;

/**
 * Class User
 * @package Domain\Models
 *
 * @property
 */
class User extends Model
{
    use Property\UserProperty;

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
