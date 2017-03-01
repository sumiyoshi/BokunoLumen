<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group([], function () use ($app) {
    $app->get('/users', ['as' => 'users', 'uses' => 'UserController@indexAction']);
    $app->get('/users/new', ['as' => 'users_new', 'uses' => 'UserController@newAction']);
    $app->get('/users/{id}', ['as' => 'users_show', 'uses' => 'UserController@showAction']);
    $app->post('/users/{id}', ['as' => 'users_create', 'uses' => 'UserController@createAction']);
    $app->get('/users/{id}/edit', ['as' => 'users_edit', 'uses' => 'UserController@editAction']);
    $app->put('/users/{id}', ['as' => 'users_update', 'uses' => 'UserController@updateAction']);
    $app->delete('/users/{id}', ['as' => 'users_delete', 'uses' => 'UserController@deleteAction']);
});