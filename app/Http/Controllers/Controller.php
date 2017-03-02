<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{

    protected function render(Request $request, $template, array $data)
    {
        return view($template, $data)
            ->with('flash', $request->session()->get('flash'))
            ->with('login_user', $request->user());
    }
}
