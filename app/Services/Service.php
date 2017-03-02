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
     * @param $options
     *
     * @return Model[]
     */
    public function getList(array $options = [])
    {
        return $this->repo->getList($options);
    }

    /**
     * @param $data
     * @param $id
     * @return Model
     */
    public function save(array $data, $id = null)
    {
        $factory = $this->validationFactory();

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

    /**
     * @return Validation\Factory
     */
    protected function validationFactory()
    {
        $filesystem = new Filesystem\Filesystem();
        $fileLoader = new Translation\FileLoader($filesystem, storage_path() . '/resources/lang');
        $translator = new Translation\Translator($fileLoader, env('APP_LOCALE'));
        return new Validation\Factory($translator);
    }
}