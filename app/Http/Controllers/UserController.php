<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function indexAction()
    {
        echo __CLASS__ . ":" . __line__;
        print'<pre>';
        var_dump(route('users'));
        print'</pre>';
        exit;

    }

    public function showAction($id)
    {
        echo __CLASS__ . ":" . __line__;
        print'<pre>';
        var_dump($id, route('users_show'));
        print'</pre>';
        exit;

    }

    public function newAction()
    {
        echo __CLASS__ . ":" . __line__;
        print'<pre>';
        var_dump(route('users_new'));
        print'</pre>';
        exit;
    }

    public function createAction()
    {

    }

    public function editAction($id)
    {
        echo __CLASS__ . ":" . __line__;
        print'<pre>';
        var_dump($id, route('users_edit'));
        print'</pre>';
        exit;
    }

    public function updateAction($id)
    {

    }

    public function deleteAction($id)
    {

    }
}
