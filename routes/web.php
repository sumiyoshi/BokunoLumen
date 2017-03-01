<?php

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['middleware' => 'auth'], function () use ($app) {
    #region users
    $app->get('/users', ['as' => 'users', 'uses' => 'UsersController@indexAction']);
    $app->get('/users/new', ['as' => 'users_new', 'uses' => 'UsersController@newAction']);
    $app->get('/users/{id:[1-9]+}', ['as' => 'users_show', 'uses' => 'UsersController@showAction']);
    $app->post('/users/{id:[1-9]+}', ['as' => 'users_create', 'uses' => 'UsersController@createAction']);
    $app->get('/users/{id:[1-9]+}/edit', ['as' => 'users_edit', 'uses' => 'UsersController@editAction']);
    $app->put('/users/{id:[1-9]+}', ['as' => 'users_update', 'uses' => 'UsersController@updateAction']);
    $app->delete('/users/{id:[1-9]+}', ['as' => 'users_delete', 'uses' => 'UsersController@deleteAction']);
    #endregion

});