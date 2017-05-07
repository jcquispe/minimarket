<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LogController@index');
Route::get('/bienvenido', 'LogController@bienvenido');
Route::get('logout', 'LogController@logout');
Route::get('ajustes', 'LogController@ajustes');
Route::get('/bienadmin', 'LogController@bienadmin');
Route::get('/bienalmacen', 'LogController@bienalmacen');
Route::get('/biensolicitud', 'LogController@biensolicitud');

Route::get('/ingreso/documento', 'IngresoController@documento');
Route::get('/solicitud/documento', 'SolicitudController@documento');
Route::get('/egreso/documento', 'EgresoController@documento');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::post('/usuario/campass', 'UsuarioController@campass');
Route::resource('usuario', 'UsuarioController');

Route::resource('log', 'LogController');
Route::post('/ingreso/anular', 'IngresoController@anular');
Route::resource('ingreso', 'IngresoController');
Route::resource('insumo', 'InsumoController');
Route::resource('producto', 'ProductoController');
Route::post('/solicitud/anular', 'SolicitudController@anular');
Route::resource('solicitud', 'SolicitudController');
Route::resource('soluser', 'SoluserController');
Route::post('/egreso/anular', 'EgresoController@anular');
Route::get('/egreso/solicitudes', 'EgresoController@solicitudes');
Route::resource('egreso', 'EgresoController');