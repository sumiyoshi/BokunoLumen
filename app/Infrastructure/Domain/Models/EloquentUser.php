<?php

namespace App\Infrastructure\Domain\Models;

class EloquentUser extends EloquentModel
{
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
}
