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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', 'UserController@index');
    $router->get('/search/{id}', 'UserController@search');
    $router->post('/', 'UserController@add');
    $router->put('/update/{id}', 'UserController@update');
    $router->delete('/delete/{id}', 'UserController@delete');
});

$router->post('/info', 'UserController@info');
$router->post('/login', 'UserController@login');
$router->post('/logout', 'UserController@logout');
