<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
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

    public function indexAction()
    {
        $list = $this->service->getList();
        return view('users.index', compact('list'));
    }

    public function showAction($id)
    {
        $user = $this->service->get($id);
        return view('users.show', compact('user'));
    }

    public function newAction()
    {
        return view('users.new', [
            'user' => $this->service->createEntity(),
            'errors' => []
        ]);
    }

    public function createAction(Request $request)
    {
        if ($model = $this->service->save($request->all())) {
            return redirect()->route('users_show', ['id' => $model->id]);
        } else {
            return view('users.new', [
                'user' => $this->service->createEntity()->fill($request->except('password')),
                'errors' => $this->service->getErrors()
            ]);
        }
    }

    public function editAction($id)
    {
        return view('users.edit', [
            'user' => $this->service->get($id)->fill(['password' => '']),
            'errors' => []
        ]);
    }

    public function updateAction(Request $request, $id)
    {
        if ($model = $this->service->save($request->all(), $id)) {
            return redirect()->route('users_show', ['id' => $model->id]);
        } else {
            return view('users.edit', [
                'user' => $this->service->get($id)->fill(['password' => ''])->fill($request->except('password')),
                'errors' => $this->service->getErrors()
            ]);
        }
    }

    public function deleteAction($id)
    {
        $this->service->delete($id);
        return redirect()->route('users');
    }
}
