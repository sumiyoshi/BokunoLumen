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
        $user = $this->service->createEntity();
        return view('users.new', compact('user'));
    }

    public function createAction(Request $request)
    {
        if ($this->service->save($request->all())) {

        } else {

        }
    }

    public function editAction($id)
    {
        $user = $this->service->get($id);
        return view('users.edit', compact('user'));
    }

    public function updateAction(Request $request, $id)
    {
        if ($this->service->save($request->all(), $id)) {

        } else {

        }
    }

    public function deleteAction($id)
    {
        $this->service->delete($id);
    }
}
