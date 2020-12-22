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
    return view('welcome');
});

Route::get('/ingreso', function () {
    return view('ingreso');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//INICIO DE SESIÓN
Route::post('authenticate', 'HomeController@authenticate')->name('authenticate');
Route::get('usuario/dashboard', 'HomeController@dashboard')->name('dashboard');
