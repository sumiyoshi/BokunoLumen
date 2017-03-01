<?php

namespace App\Services;

use App\Models\Model;
use App\Repositories\RepositoryInterface;
use Illuminate\Validation;
use Illuminate\Filesystem;
use Illuminate\Translation;

abstract class Service implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repo;


    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param $id
     * @return Model
     */
    public function get($id)
    {
        return $this->repo->get($id);
    }

    /**
     * @return Model[]
     */
    public function getList()
    {
        return $this->repo->getList();
    }

    /**
     * @param $data
     * @param $id
     * @return Model
     */
    public function save(array $data, $id = null)
    {
        $filesystem = new Filesystem\Filesystem();
        $fileLoader = new Translation\FileLoader($filesystem, '');
        $translator = new Translation\Translator($fileLoader, 'en_En');
        $factory = new Validation\Factory($translator);

        $v = $factory->make($data, $this->rules);
        if ($v->fails()) {
            $this->errors = $v->messages()->toArray();
            return false;
        }

        if (is_null($id)) {
            $model = $this->repo->create($data);
        } else {
            $model = $this->repo->update($id, $data);
        }

        return $model;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        if ($this->repo->delete($id) === 1) {
            return true;
        }

        return false;
    }

    /**
     * @return Model
     */
    public function createEntity()
    {
        return $this->repo->createEntity();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}