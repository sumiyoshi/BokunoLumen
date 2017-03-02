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

    public function indexAction(Request $request)
    {
        $list = $this->service->getList();
        return view('users.index', compact('list'))
            ->with('flash', $request->session()->get('flash'));
    }

    public function showAction(Request $request, $id)
    {
        $user = $this->service->get($id);
        return view('users.show', compact('user'))
            ->with('flash', $request->session()->get('flash'));
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
            $request->session()->flash('flash', 'User created successfully.');
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
            $request->session()->flash('flash', 'User updated successfully.');
            return redirect()->route('users_show', ['id' => $model->id]);
        } else {
            return view('users.edit', [
                'user' => $this->service->get($id)->fill(['password' => ''])->fill($request->except('password')),
                'errors' => $this->service->getErrors()
            ]);
        }
    }

    public function deleteAction(Request $request, $id)
    {
        $this->service->delete($id);
        $request->session()->flash('flash', 'User deleted successfully.');
        return redirect()->route('users');
    }
}
