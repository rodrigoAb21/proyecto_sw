<?php

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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/usuario/editar', 'UsuarioController@editar')->middleware('auth');
Route::patch('/usuario/editar', 'UsuarioController@actualizar')->middleware('auth');
Route::get('/cartera', 'CuentaController@verMovimientos')->middleware('auth');
Route::resource('/vehiculos','VehiculoController')->middleware('auth');
Route::resource('/servicio/ofrecer','ServicioController')->middleware('auth');
Route::resource('/servicio/solicitar','ServicioClienteController')->middleware('auth');

Route::post('/servicio/solicitar/busqueda', 'ServicioClienteController@buscar')->middleware('auth');
Route::get('/servicio/solicitar/detalle/{id}', 'ServicioClienteController@detalle')->middleware('auth');



Route::get('/pago', 'CajaController@nuevoPago')->middleware('auth');


Route::post('/pago', 'CajaController@realizarPago')->middleware('auth');

Route::get('/servicio', function () {
    return view('servicios.opciones');
})->middleware('auth');

Route::resource('/rutas','RutaController')->middleware('auth');
Route::resource('/mensajes','MensajeController')->middleware('auth');