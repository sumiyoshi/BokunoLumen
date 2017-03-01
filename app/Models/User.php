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
     * @return $this
     */
    public function passwordHash()
    {
        if ($this->password) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        return $this;
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
