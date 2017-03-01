<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation;
use Illuminate\Filesystem;
use Illuminate\Translation;


class Model extends EloquentModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}