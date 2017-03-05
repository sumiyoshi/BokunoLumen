<?php

namespace Infrastructure\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static find($id)
 * @method static Builder where($string, $value)
 * @method static create($params)
 * @method static Builder condition($option)
 * @method static Builder paginate($option)
 */
abstract class EloquentModel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $domain_model;


    /**
     * @param Builder $builder
     * @param array $options
     * @return Builder
     */
    public function scopeCondition(Builder $builder, array $options)
    {
        return $builder;
    }

    /**
     * @param Builder $builder
     * @param array $options
     * @return Builder
     */
    public function scopePaginate(Builder $builder, array $options)
    {
        return $builder;
    }

    /**
     * @return \Domain\Models\Model
     */
    public function toDomain()
    {
        return new $this->domain_model($this->toArray());
    }
}