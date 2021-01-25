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

// Route::get('/crud', function () {
//     return view('welcome');
// });

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
Route::post('compararEmail', 'UserController@compararEmail')->name('compararEmail');
Route::post('compararUsuario', 'UserController@compararUsuario')->name('compararUsuario');



