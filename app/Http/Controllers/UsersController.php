<?php

namespace App\Http\Controllers;

use App\Domain\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var UsersService
     */
    private $service;

    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    public function indexAction(Request $request)
    {
        $list = $this->service->getList();
        return $this->render($request, 'users.index', compact('list'));
    }

    public function showAction(Request $request, $id)
    {
        $user = $this->service->get($id);
        return $this->render($request, 'users.show', compact('user'));
    }

    public function newAction(Request $request)
    {
        return $this->render($request, 'users.new', [
            'user' => $this->service->createEntity(),
            'errors' => []
        ]);
    }

    public function createAction(Request $request)
    {
        $errors = $this->requestValidation($request, $this->getRules());

        if ($errors) {
            return $this->render($request, 'users.new', [
                'user' => $this->service->createEntity()->setProperties($request->except('password')),
                'errors' => $errors
            ]);
        }

        $model = $this->service->save($request->all());
        $request->session()->flash('flash', 'User created successfully.');
        return redirect()->route('users_show', ['id' => $model->id]);
    }

    public function editAction(Request $request, $id)
    {
        return $this->render($request, 'users.edit', [
            'user' => $this->service->get($id)->setProperties(['password' => '']),
            'errors' => []
        ]);
    }

    public function updateAction(Request $request, $id)
    {
        $errors = $this->requestValidation($request, $this->getRules());

        if ($errors) {
            return $this->render($request, 'users.edit', [
                'user' => $this->service->get($id)->setProperties(['password' => ''])->setProperties($request->except('password')),
                'errors' => $errors
            ]);
        }

        $this->service->save($request->all(), $id);
        $request->session()->flash('flash', 'User updated successfully.');
        return redirect()->route('users_show', ['id' => $id]);
    }

    public function deleteAction(Request $request, $id)
    {
        $this->service->delete($id);
        $request->session()->flash('flash', 'User deleted successfully.');
        return redirect()->route('users');
    }

    /**
     * @return array
     */
    private function getRules()
    {
        return [
            "name" => "required|max:100",
            "login_id" => "required|max:100",
            "password" => "required|max:100",
            "mail" => "required|max:255"
        ];
    }
}
