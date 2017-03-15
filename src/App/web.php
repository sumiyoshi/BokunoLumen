<?php

$app->group(['middleware' => ['auth']], function () use ($app) {

    #region home
    $app->get('/', ['as' => 'home', 'uses' => 'HomeController@indexAction']);
    #endregion

    $app->group(['middleware' => ['access']], function () use ($app) {
        resources($app, 'users');
    });

});

$app->get('/login', ['as' => 'login', 'uses' => 'AuthController@indexAction']);
$app->post('/login', ['as' => 'login_post', 'uses' => 'AuthController@loginAction']);
$app->get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logoutAction']);

