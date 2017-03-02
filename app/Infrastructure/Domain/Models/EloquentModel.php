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

    protected $domain_model;

    /**
     * @return \App\Domain\Models\Model
     */
    public function toDomain()
    {
        return new $this->domain_model($this->toArray());
    }
}