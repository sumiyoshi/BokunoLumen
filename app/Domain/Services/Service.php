<?php

namespace App\Domain\Services;

use Illuminate\Validation;
use Illuminate\Filesystem;
use Illuminate\Translation;

abstract class Service
{

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $errors = [];

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

        $fileLoader = new Translation\FileLoader($filesystem, resource_path('lang'));
        $translator = new Translation\Translator($fileLoader, env('APP_LOCALE'));
        return new Validation\Factory($translator);
    }
}