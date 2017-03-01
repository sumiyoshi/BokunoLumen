<?php

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['middleware' => 'auth'], function () use ($app) {
    #region users
    $app->get('/users', ['as' => 'users', 'uses' => 'UserController@indexAction']);
    $app->get('/users/new', ['as' => 'users_new', 'uses' => 'UserController@newAction']);
    $app->get('/users/{id:[1-9]+}', ['as' => 'users_show', 'uses' => 'UserController@showAction']);
    $app->post('/users/{id:[1-9]+}', ['as' => 'users_create', 'uses' => 'UserController@createAction']);
    $app->get('/users/{id:[1-9]+}/edit', ['as' => 'users_edit', 'uses' => 'UserController@editAction']);
    $app->put('/users/{id:[1-9]+}', ['as' => 'users_update', 'uses' => 'UserController@updateAction']);
    $app->delete('/users/{id:[1-9]+}', ['as' => 'users_delete', 'uses' => 'UserController@deleteAction']);
    #endregion

});