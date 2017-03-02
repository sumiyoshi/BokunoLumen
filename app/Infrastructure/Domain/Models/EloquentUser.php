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

    /**
     * @var array
     */
    protected $fillable = [
        'password',
        'mail',
        'name'
    ];
}
