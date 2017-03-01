<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
        'login_id',
        'password',
        'mail',
        'name'
    ];

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
