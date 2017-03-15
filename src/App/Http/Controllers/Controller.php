<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation;
use Illuminate\Filesystem;
use Illuminate\Translation;

class Controller extends BaseController
{

    protected function render(Request $request, $template, array $data)
    {
        return view($template, $data)
            ->with('flash', $request->session()->get('flash'))
            ->with('login_user', $request->user());
    }

    /**
     * @return Validation\Factory
     */
    public function requestValidation(array $data, array $rules)
    {
        $filesystem = new Filesystem\Filesystem();

        $fileLoader = new Translation\FileLoader($filesystem, resource_path('lang'));
        $translator = new Translation\Translator($fileLoader, env('APP_LOCALE'));
        $factory = new Validation\Factory($translator);
        $validation = $factory->make($data, $rules);

        if ($validation->fails()) {
            return [
                false,
                $validation->messages()->toArray()
            ];
        }

        return [
            true,
            $validation->getData()
        ];
    }

}
