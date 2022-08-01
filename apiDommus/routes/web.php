<?php

use app\Http\Controllers\EmpreendimentoController;
use app\Http\Controllers\UnidadeController;
/** @var \Laravel\Lumen\Routing\Router $router */

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

//ROTAS DO CONTROLLER EMPREENDIMENTO
$router->get('/', 'EmpreendimentoController@index');
$router->post('/novoempreendimento','EmpreendimentoController@store');
$router->get('/verempreendimento/{id}','EmpreendimentoController@show');
$router->put('/atualizarempreendimento','EmpreendimentoController@update');
$router->delete('/deletarempreendimento/{id}','EmpreendimentoController@delete');
$router->get('/minhasunidades','EmpreendimentoController@listMyUnidades');

//ROTAS DO CONTROLLER UNIDADE
$router->get('/unidades','UnidadeController@index');
$router->post('/novaunidade','UnidadeController@store');
$router->get('/verunidade/{id}','UnidadeController@show');
$router->put('/atualizarunidade','UnidadeController@update');
$router->delete('/deletarunidade/{id}','UnidadeController@delete');
$router->get('/totalvendas','UnidadeController@allSalesCash');
$router->get('/unidadesvendidas','UnidadeController@allSales');
$router->get('/unidadesreservadas','UnidadeController@allReserve');
$router->get('/unidadesdisponiveis','UnidadeController@allAvailable');



//ROTAS DO CONTROLLER USER
$router->get('/usuarios','UserController@index');
