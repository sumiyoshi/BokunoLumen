<?php

namespace App\Infrastructure\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static find($id)
 * @method static Builder where($string, $value)
 * @method static create($params)
 */
abstract class EloquentModel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function toDomain()
    {
        
    }
}