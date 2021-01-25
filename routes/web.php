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
    return view('ingreso');
});

Route::get('/crud', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//INICIO DE SESIÓN
Route::post('authenticate', 'HomeController@authenticate')->name('authenticate');
Route::get('getperfil', 'HomeController@getperfil')->name('getperfil');
Route::get('logout', 'HomeController@logout')->name('logout');
Route::get('usuario', 'HomeController@dashboard')->name('dashboard');
