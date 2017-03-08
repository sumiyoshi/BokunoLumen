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
        foreach ($data as $key => $row) {
            if (!property_exists($this, $key)) {
                continue;
            }

            $this->{$key} = $row;
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
