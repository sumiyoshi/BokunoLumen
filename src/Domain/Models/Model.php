<?php

namespace Domain\Models;


abstract class Model
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
     */
    public $updated_at;

    /**
     * @var string
     */
    public $deleted_at;

    /**
     * @param array $data
     * @return $this
     */
    public function setProperties(array $data)
    {
        $reflection = new \ReflectionClass(static::class);

        foreach ($reflection->getProperties() as $property) {

            if (!$property->isPublic()) {
                continue;
            }
            
            if (!isset($data[$property->getName()])) {
                continue;
            }
            
            $this->{$property->getName()} = $data[$property->getName()];
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $list = [];
        foreach ($this as $key => $row) {
            $list[$key] = $row;
        }

        return $list;
    }
}
