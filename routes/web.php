<?php

$app->group(['middleware' => ['auth']], function () use ($app) {
    #region users
    $app->get('/users', ['as' => 'users', 'uses' => 'UsersController@indexAction']);
    $app->get('/users/new', ['as' => 'users_new', 'uses' => 'UsersController@newAction']);
    $app->get('/users/{id:[1-9]+}', ['as' => 'users_show', 'uses' => 'UsersController@showAction']);
    $app->post('/users/', ['as' => 'users_create', 'uses' => 'UsersController@createAction']);
    $app->get('/users/{id:[1-9]+}/edit', ['as' => 'users_edit', 'uses' => 'UsersController@editAction']);
    $app->post('/users/{id:[1-9]+}/update', ['as' => 'users_update', 'uses' => 'UsersController@updateAction']);
    $app->post('/users/{id:[1-9]+}/delete', ['as' => 'users_delete', 'uses' => 'UsersController@deleteAction']);
    #endregion
});

