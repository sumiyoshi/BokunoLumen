<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function indexAction(Request $request)
    {
        return $this->render($request, 'auth.login', [
            'errors' => false
        ]);
    }

    public function loginAction(Request $request)
    {
        list($res, $data) = $this->requestValidation($request->all(), $this->getRules());

        if (!$res) {
            return $this->render($request, 'auth.login', [
                'errors' => $data
            ]);
        }

        $id = $this->service->login($request->input('mail'), $request->input('password'));

        if (!$id) {
            return $this->render($request, 'auth.login', [
                'errors' => true
            ]);
        }

        $request->session()->put('id', $id);

        return redirect()->route('home');
    }

    public function logoutAction(Request $request)
    {
        $request->session()->remove('id');
        return redirect()->route('login');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return [
            "mail" => "required|max:255",
            "password" => "required|max:100"

        ];
    }
}
