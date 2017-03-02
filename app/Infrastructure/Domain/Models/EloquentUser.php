<?php

namespace App\Infrastructure\Domain\Models;

use App\Domain\Models\User;

class EloquentUser extends EloquentModel
{
    /**
     * @var string
     */
    protected $table = 'users';

    protected $domain_model = User::class;

    protected $fillable = [
        'login_id',
        'password',
        'mail',
        'name'
    ];
}
