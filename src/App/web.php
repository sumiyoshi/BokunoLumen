<?php

$app->group(['middleware' => ['auth']], function () use ($app) {

    #region home
    $app->get('/', ['as' => 'home', 'uses' => 'HomeController@indexAction']);
    #endregion

    $app->group(['middleware' => ['access']], function () use ($app) {
        #region users
        $app->get('/users', ['as' => 'users', 'uses' => 'UsersController@indexAction']);
        $app->get('/users/new', ['as' => 'users_new', 'uses' => 'UsersController@newAction']);
        $app->get('/users/{id:[0-9]+}', ['as' => 'users_show', 'uses' => 'UsersController@showAction']);
        $app->post('/users/', ['as' => 'users_create', 'uses' => 'UsersController@createAction']);
        $app->get('/users/{id:[0-9]+}/edit', ['as' => 'users_edit', 'uses' => 'UsersController@editAction']);
        $app->post('/users/{id:[0-9]+}/update', ['as' => 'users_update', 'uses' => 'UsersController@updateAction']);
        $app->post('/users/{id:[0-9]+}/delete', ['as' => 'users_delete', 'uses' => 'UsersController@deleteAction']);
        #endregion
    });

});

$app->get('/login', ['as' => 'login', 'uses' => 'AuthController@indexAction']);
$app->post('/login', ['as' => 'login_post', 'uses' => 'AuthController@loginAction']);
$app->get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logoutAction']);

