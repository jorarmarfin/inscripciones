<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
require __DIR__.'/home.route.php';
require __DIR__.'/admin.route.php';
require __DIR__.'/catalogo.route.php';
require __DIR__.'/users.route.php';
require __DIR__.'/datos.route.php';
require __DIR__.'/pagos.route.php';
require __DIR__.'/ficha.route.php';
require __DIR__.'/resultados.route.php';

Auth::routes();

//Route::get('/home', 'HomeController@index');