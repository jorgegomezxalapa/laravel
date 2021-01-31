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
Route::post('createUser', 'UserController@create')->name('createUser');
Route::post('deleteUser', 'UserController@deleteUser')->name('deleteUser');
Route::post('editUser', 'UserController@editUser')->name('editUser');
Route::post('compararEmail', 'UserController@compararEmail')->name('compararEmail');
Route::post('compararUsuario', 'UserController@compararUsuario')->name('compararUsuario');
Route::get('getUsuarios', 'UserController@getUsers')->name('getUsuarios');
Route::post('getUsuario', 'UserController@getUser')->name('getUsuario');

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
