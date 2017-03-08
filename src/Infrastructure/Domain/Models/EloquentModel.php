<?php

namespace Infrastructure\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static find($id)
 * @method static Builder where($string, $value)
 * @method static Builder condition($option)
 * @method static Builder paginate($limit, $offset)
 */
abstract class EloquentModel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $domain_model;

    /**
     * @return \Domain\Models\Model
     */
    public function toDomain()
    {
        /** @var \Domain\Models\Model $model */
        $model = app()->make($this->domain_model);
        return $model->setProperties($this->toArray());
    }

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
     * @param $limit
     * @param $offset
     * @return Builder
     */
    public function scopePaginate(Builder $builder, $limit, $offset)
    {
        return $builder->limit($limit)->offset($offset)->orderBy('id');
    }
}
