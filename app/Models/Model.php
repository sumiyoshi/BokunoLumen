<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Model
 * @package App\Models
 *
 * @method static find($id)
 * @method static Builder where($string, $value)
 * @method static create($params)
 */
abstract class Model extends EloquentModel implements ModelInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}