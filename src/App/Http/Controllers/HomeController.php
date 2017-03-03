<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render($request, 'home.index', []);
    }
}