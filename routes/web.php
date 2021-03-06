<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FormularioController@index');

Route::resource('medicos','MedicosController');
Route::resource('especialidades','EspecialidadesController');
Route::resource('usuarios','UsuarioController');
Route::resource('estados', 'EstadosController');
Route::resource('regllamadas', 'Call_LogController');

Route::post('ficha/archivo','FormularioController@archivo');
Route::get('ficha/listar','FormularioController@listar');
Route::get('ficha/getMedicos','FormularioController@getMedicos');
Route::post('ficha/mensajeria','FormularioController@mensajeria');
Route::post('ficha/llamada','FormularioController@llamada');
Route::post('ficha/callstatereg','Call_LogController@callstatereg');
Route::post('ficha/changestatus','FormularioController@changestatus');
Route::post('ficha/changelugar','FormularioController@changelugar');
Route::post('estados/update','EstadosController@update');

Route::resource('ficha','FormularioController');
Auth::routes();
