<?php

namespace Infrastructure\Domain\Models;

use Domain\Models\User;

class EloquentUser extends EloquentModel
{
    /**
     * @var string
     */
    protected $table = 'users';

    protected $domain_model = User::class;

}
