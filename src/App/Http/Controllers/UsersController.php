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
        list($res, $data) = $this->requestValidation($request->all(), $this->getRules());

        if (!$res) {
            return $this->render($request, 'users.new', [
                'user' => $this->service->createEntity()->setProperties($request->except('password')),
                'errors' => $data
            ]);
        }

        $model = $this->service->save($data);
        $request->session()->flash('flash', trans('message.created', ['attribute' => 'User'], env('APP_LOCALE')));
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
        list($res, $data) = $this->requestValidation($request->all(), $this->getRules());

        if (!$res) {
            return $this->render($request, 'users.edit', [
                'user' => $this->service->get($id)->setProperties(['password' => ''])->setProperties($request->except('password')),
                'errors' => $data
            ]);
        }

        $this->service->save($data, $id);
        $request->session()->flash('flash', trans('message.updated', ['attribute' => 'User'], env('APP_LOCALE')));
        return redirect()->route('users_show', ['id' => $id]);
    }

    public function deleteAction(Request $request, $id)
    {
        $this->service->delete($id);
        $request->session()->flash('flash', trans('message.deleted', ['attribute' => 'User'], env('APP_LOCALE')));
        return redirect()->route('users');
    }

    /**
     * @return array
     */
    public function getRules()
    {
        return [
            "name" => "required|max:100",
            "password" => "required|max:100",
            "mail" => "required|max:255"
        ];
    }
}
