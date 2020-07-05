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

$router->group(['middleware' => ['json', 'auth']], function () use ($router)
{
    // controller productos
    $router->get('/api/productos', ['uses' => 'ProductsController@index']);
    $router->get('/api/productos/{id}', ['uses' => 'ProductsController@id_producto']);
    // controller car
    $router->get('/api/car', ['uses' => 'CarController@index']);
    $router->post('/api/car', ['uses' => 'CarController@create']);
    $router->put('/api/car', ['uses' => 'CarController@update']);
    $router->delete('/api/car', ['uses' => 'CarController@delete']);
    // controller categorias
    $router->get('/api/categorias', ['uses' => 'CategoriaController@index']);
});
