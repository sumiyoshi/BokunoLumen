<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {

    }

    public function indexAction()
    {
        return view('users.index', ['id' => 1, 'name' => 'test']);
    }

    public function showAction($id)
    {
    }

    public function newAction(Request $request)
    {
    }

    public function createAction(Request $request)
    {
    }

    public function editAction($id)
    {
    }

    public function updateAction(Request $request, $id)
    {
    }

    public function deleteAction($id)
    {
    }
}
