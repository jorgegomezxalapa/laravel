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

Route::post('upload', 'ArchivosController@index')->name('upload');

Route::get('getAll', 'CotizacionController@getAll')->name('getAll');
Route::get('getAllClientes', 'CotizacionController@getAllClientes')->name('getAllClientes');
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
Route::get('getClientesDasboard', 'ClienteController@getClientesDasboard')->name('getClientesDasboard');
Route::post('createCliente', 'ClienteController@createCliente')->name('createCliente');
Route::post('editarCliente', 'ClienteController@editarCliente')->name('editarCliente');
Route::post('getCliente', 'ClienteController@getCliente')->name('getCliente');
Route::post('filtrarBusquedaClientes', 'ClienteController@filtrarBusquedaClientes')->name('filtrarBusquedaClientes');

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
Route::post('guardarDocumentos', 'CotizacionController@guardarDocumentos')->name('guardarDocumentos');
Route::get('getSolicitadas', 'CotizacionController@getSolicitadas')->name('getSolicitadas');
Route::get('getPartidas', 'CotizacionController@getPartidas')->name('getPartidas');
Route::post('getPartidasCotizacion', 'CotizacionController@getPartidasCotizacion')->name('getPartidasCotizacion');
Route::get('getProceso', 'CotizacionController@getProceso')->name('getProceso');
Route::get('getCotizadas', 'CotizacionController@getCotizadas')->name('getCotizadas');
Route::get('getAlmacen', 'CotizacionController@getAlmacen')->name('getAlmacen');
Route::get('getAlmacenSolicitadas', 'CotizacionController@getAlmacenSolicitadas')->name('getAlmacenSolicitadas');

Route::get('actualizarPInventario', 'CotizacionController@actualizarPInventario')->name('actualizarPInventario');
Route::post('getCotizacion', 'CotizacionController@getCotizacion')->name('getCotizacion');
Route::post('saveConfigCotizacion', 'CotizacionController@saveConfigCotizacion')->name('saveConfigCotizacion');
Route::post('savePartida', 'CotizacionController@savePartida')->name('savePartida');
Route::post('savePartidaCotizacion', 'CotizacionController@savePartidaCotizacion')->name('savePartidaCotizacion');
Route::post('saveInventario', 'CotizacionController@saveInventario')->name('saveInventario');
Route::post('editarPartida', 'CotizacionController@editarPartida')->name('editarPartida');
Route::post('mejorarPartida', 'CotizacionController@mejorarPartida')->name('mejorarPartida');
Route::post('iniciarCotizacion', 'CotizacionController@iniciarCotizacion')->name('iniciarCotizacion');
Route::post('setIvaCotizacion', 'CotizacionController@setIvaCotizacion')->name('setIvaCotizacion');
Route::post('setIepsCotizacion', 'CotizacionController@setIepsCotizacion')->name('setIepsCotizacion');

Route::post('complementarDetalle', 'CotizacionController@complementarDetalle')->name('complementarDetalle');


Route::post('finalizarCotizacion', 'CotizacionController@finalizarCotizacion')->name('finalizarCotizacion');
Route::post('disponiblecompra', 'CotizacionController@disponiblecompra')->name('disponiblecompra');
Route::post('disponiblefactura', 'CotizacionController@disponiblefactura')->name('disponiblefactura');
Route::post('comprada', 'CotizacionController@comprada')->name('comprada');
Route::post('disponibleentrega', 'CotizacionController@disponibleentrega')->name('disponibleentrega');
Route::post('entregada', 'CotizacionController@entregada')->name('entregada');
Route::post('cobrada', 'CotizacionController@cobrada')->name('cobrada');

//utilidades
Route::post('createUtilidad', 'UtilidadController@createUtilidad')->name('createUtilidad');
Route::get('getUtilidades', 'UtilidadController@getUtilidades')->name('getUtilidades');
Route::post('getUtilidad', 'UtilidadController@getUtilidad')->name('getUtilidad');
Route::post('editarUtilidad', 'UtilidadController@editarUtilidad')->name('editarUtilidad');

Route::post('setTipoVenta', 'UtilidadController@setTipoVenta')->name('setTipoVenta');

//AlmacenController
Route::post('registroinventario', 'AlmacenController@registro')->name('registroinventario');
Route::post('actualizarIngresoPartida', 'AlmacenController@actualizarIngresoPartida')->name('actualizarIngresoPartida');
Route::post('nuevoSegmento', 'AlmacenController@nuevoSegmento')->name('nuevoSegmento');
Route::get('getSegmentos', 'AlmacenController@getSegmentos')->name('getSegmentos');
Route::get('getInventario', 'AlmacenController@getInventario')->name('getInventario');
Route::get('getInventarioTotal', 'AlmacenController@getInventarioTotal')->name('getInventarioTotal');
Route::get('getEntradas', 'AlmacenController@getEntradas')->name('getEntradas');
Route::post('salidaPartida', 'AlmacenController@salidaPartida')->name('salidaPartida');
Route::get('getSalidas', 'AlmacenController@getSalidas')->name('getSalidas');
Route::get('getInventarioSolicitado', 'AlmacenController@getInventarioSolicitado')->name('getInventarioSolicitado');

//DOCUMENTOS WORD
Route::get('getDescarga/{idDocumento}/{idCotizacion}', 'WordController@getDescarga')->name('getDescarga');
Route::get('descargarDocumento/{cotizacion}/{rs}/{tipo}/{documento}', 'WordController@descargarDocumento')->name('descargarDocumento');

//DOCUMENTOS EXCEL
Route::get('excel', 'PartidasController@excel')->name('excel');
Route::get('getExcel/{tipo}', 'PartidasController@getExcel')->name('getExcel');


//GESTION
Route::post('nuevaRazon', 'GestionController@nuevaRazon')->name('nuevaRazon');
Route::get('getRazon', 'GestionController@getRazon')->name('getRazon');
Route::post('editarRazon', 'GestionController@editarRazon')->name('editarRazon');
Route::post('nuevoFormato', 'GestionController@nuevoFormato')->name('nuevoFormato');
Route::get('getFormato', 'GestionController@getFormato')->name('getFormato');
Route::post('editarFormato', 'GestionController@editarFormato')->name('editarFormato');
Route::post('nuevoDocumento', 'GestionController@nuevoDocumento')->name('nuevoDocumento');
Route::get('getDocumento', 'GestionController@getDocumento')->name('getDocumento');
Route::post('editarDocumento', 'GestionController@editarDocumento')->name('editarDocumento');
Route::post('getDocumentosF', 'GestionController@getDocumentosF')->name('getDocumentosF');


//VENTAS

Route::post('turnarVenta', 'VentasController@turnarVenta')->name('turnarVenta');
Route::get('getVentas', 'VentasController@getVentas')->name('getVentas');
Route::post('getVenta', 'VentasController@getVenta')->name('getVenta');
Route::post('updateVenta', 'VentasController@updateVenta')->name('updateVenta');