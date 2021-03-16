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

Route::get('/crud', function () {
    return view('welcome');
});

//inicio de sesión
Route::get('/', function () {
    return view('ingreso');
});
Route::post('authenticate', 'HomeController@authenticate')->name('authenticate');

//dashboard
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('getperfil', 'HomeController@getperfil')->name('getperfil');
Route::get('logout', 'HomeController@logout')->name('logout');

Auth::routes();

//usuarios
Route::post('ingreso', 'UserController@ingreso')->name('ingreso');
Route::post('createUser', 'UserController@create')->name('createUser');
Route::post('deleteUser', 'UserController@deleteUser')->name('deleteUser');
Route::post('editUser', 'UserController@editUser')->name('editUser');
Route::post('compararEmail', 'UserController@compararEmail')->name('compararEmail');
Route::post('compararUsuario', 'UserController@compararUsuario')->name('compararUsuario');
Route::get('getUsuarios', 'UserController@getUsers')->name('getUsuarios');
Route::post('getUsuario', 'UserController@getUser')->name('getUsuario');
Route::post('getDetalle', 'UserController@getDetalle')->name('getDetalle');

//clientes
Route::get('getClientes', 'ClienteController@getClientes')->name('getClientes');
Route::post('createCliente', 'ClienteController@createCliente')->name('createCliente');
Route::post('editarCliente', 'ClienteController@editarCliente')->name('editarCliente');
Route::post('getCliente', 'ClienteController@getCliente')->name('getCliente');

//solicitudes
Route::post('createSolicitud', 'SolicitudController@create')->name('createSolicitud');
Route::post('editarSolicitud', 'SolicitudController@editarSolicitud')->name('editarSolicitud');
Route::get('getSolicitudes', 'SolicitudController@getSolicitudes')->name('getSolicitudes');
Route::post('getSolicitud', 'SolicitudController@getSolicitud')->name('getSolicitud');

//solicitantes
Route::post('createSolicitante', 'SolicitantesController@createSolicitante')->name('createSolicitante');
Route::get('getSolicitantes', 'SolicitantesController@getSolicitantes')->name('getSolicitantes');
Route::post('getSolicitante', 'SolicitantesController@getSolicitante')->name('getSolicitante');
Route::post('editarSolicitante', 'SolicitantesController@editarSolicitante')->name('editarSolicitante');

//catalogos
Route::get('catalogosSolicitud', 'CatalogosController@catalogosSolicitud')->name('catalogosSolicitud');

//cotizaciones
Route::get('getCotizaciones', 'CotizacionController@getCotizaciones')->name('getCotizaciones');
Route::get('getAlmacen', 'CotizacionController@getAlmacen')->name('getAlmacen');
Route::get('getAlmacenSolicitadas', 'CotizacionController@getAlmacenSolicitadas')->name('getAlmacenSolicitadas');

Route::get('actualizarPInventario', 'CotizacionController@actualizarPInventario')->name('actualizarPInventario');
Route::post('getCotizacion', 'CotizacionController@getCotizacion')->name('getCotizacion');
Route::post('saveConfigCotizacion', 'CotizacionController@saveConfigCotizacion')->name('saveConfigCotizacion');
Route::post('savePartida', 'CotizacionController@savePartida')->name('savePartida');
Route::post('saveInventario', 'CotizacionController@saveInventario')->name('saveInventario');
Route::post('editarPartida', 'CotizacionController@editarPartida')->name('editarPartida');
Route::post('iniciarCotizacion', 'CotizacionController@iniciarCotizacion')->name('iniciarCotizacion');

//utilidades
Route::post('createUtilidad', 'UtilidadController@createUtilidad')->name('createUtilidad');
Route::get('getUtilidades', 'UtilidadController@getUtilidades')->name('getUtilidades');
Route::post('getUtilidad', 'UtilidadController@getUtilidad')->name('getUtilidad');
Route::post('editarUtilidad', 'UtilidadController@editarUtilidad')->name('editarUtilidad');

//AlmacenController
Route::post('registroinventario', 'AlmacenController@registro')->name('registroinventario');
Route::post('nuevoSegmento', 'AlmacenController@nuevoSegmento')->name('nuevoSegmento');
Route::get('getSegmentos', 'AlmacenController@getSegmentos')->name('getSegmentos');
Route::get('getInventario', 'AlmacenController@getInventario')->name('getInventario');
Route::get('getEntradas', 'AlmacenController@getEntradas')->name('getEntradas');
Route::post('salidaPartida', 'AlmacenController@salidaPartida')->name('salidaPartida');
Route::get('getSalidas', 'AlmacenController@getSalidas')->name('getSalidas');
