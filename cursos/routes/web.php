<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();


/*Route::get('/', function () {
    return view('panel.home');
})->name('panel.index');
*/



Route::get('/', 'HomeController@index')->name('panel.index');

Route::get('/capacitadores','CapacitadoresController@index')->name('capacitadores.index')->middleware('auth');
Route::get('/capacitadores/agregar','CapacitadoresController@new')->name('capacitadores.new')->middleware('auth');
Route::post('/capacitadores/agregar','CapacitadoresController@add')->name('capacitadores.add')->middleware('auth');
Route::get('/capacitadores/{capacitador}','CapacitadoresController@edit')->name('capacitadores.edit')->middleware('auth');
Route::put('/capacitadores/{capacitador}','CapacitadoresController@update')->name('capacitadores.update')->middleware('auth');
Route::delete('/capacitadores/{capacitador}','CapacitadoresController@delete')->name('capacitadores.delete')->middleware('auth');
Route::get('/capacitadores/{capacitador}/show','CapacitadoresController@show')->name('capacitadores.show')->middleware('auth');

Route::get('/cursantes','CursantesController@index')->name('cursantes.index')->middleware('auth');
Route::get('/cursantes/agregar','CursantesController@new')->name('cursantes.new')->middleware('auth');
Route::post('/cursantes/agregar','CursantesController@add')->name('cursantes.add')->middleware('auth');
Route::get('/cursantes/{cursante}','CursantesController@edit')->name('cursantes.edit')->middleware('auth');
Route::put('/cursantes/{cursante}','CursantesController@update')->name('cursantes.update')->middleware('auth');
Route::delete('/cursantes/{cursante}','CursantesController@delete')->name('cursantes.delete')->middleware('auth');
Route::get('/cursantes/search/{string?}','CursantesController@search')->name('cursantes.search')->middleware('auth');
Route::get('/cursantes/{cursante}/show','CursantesController@show')->name('cursantes.show')->middleware('auth');

Route::get('/cursos','CursosController@index')->name('cursos.index')->middleware('auth');
Route::get('/cursos/agregar','CursosController@new')->name('cursos.new')->middleware('auth');
Route::post('/cursos/agregar','CursosController@add')->name('cursos.add')->middleware('auth');
Route::get('/cursos/{curso}','CursosController@edit')->name('cursos.edit')->middleware('auth');
Route::put('/cursos/{curso}','CursosController@update')->name('cursos.update')->middleware('auth');
Route::delete('/cursos/{curso}','CursosController@delete')->name('cursos.delete')->middleware('auth');

Route::get('/catedras/vigentes','CatedrasController@vigentes')->name('catedras.vigentes')->middleware('auth');
Route::get('/catedras/vencidas','CatedrasController@vencidas')->name('catedras.vencidas')->middleware('auth');
Route::get('/catedras/agregar','CatedrasController@new')->name('catedras.new')->middleware('auth');
Route::post('/catedras/agregar','CatedrasController@add')->name('catedras.add')->middleware('auth');
Route::get('/catedras/{catedra}/show','CatedrasController@show')->name('catedras.show')->middleware('auth');
Route::get('/catedras/{catedra}','CatedrasController@edit')->name('catedras.edit')->middleware('auth');
Route::put('/catedras/{catedra}','CatedrasController@update')->name('catedras.update')->middleware('auth');
Route::delete('/catedras/{catedra}','CatedrasController@delete')->name('catedras.delete')->middleware('auth');
Route::post('/catedras/{catedra}/restore','CatedrasController@restore')->name('catedras.restore')->middleware('auth');


Route::get('/feriados','FeriadosController@index')->name('feriados.index')->middleware('auth');
Route::get('/feriados/data/{mes}','FeriadosController@data')->name('feriados.data')->middleware('auth');
Route::post('/feriados/agregar','FeriadosController@add')->name('feriados.add')->middleware('auth');
Route::delete('/feriados/{feriado}','FeriadosController@delete')->name('feriados.delete')->middleware('auth');

Route::get('/fechas/agregar/{catedra}','FechasController@new')->name('fechas.new')->middleware('auth');
Route::put('/fechas/agregar/{catedra}','FechasController@update')->name('fechas.update')->middleware('auth');

Route::post('/fechas/agregar/{catedra}','FechasController@add')->name('fechas.add')->middleware('auth');

Route::get('/fechas/{fecha}','FechasController@edit')->name('fechas.edit')->middleware('auth');
Route::put('/fechas/{fecha}','FechasController@update')->name('fechas.update')->middleware('auth');
Route::delete('/fechas/{fecha}','FechasController@delete')->name('fechas.delete')->middleware('auth');

Route::get('/inscripciones','InscripcionesController@index')->name('inscripciones.index')->middleware('auth');
Route::get('/inscripciones/agregar','InscripcionesController@new')->name('inscripciones.new')->middleware('auth');
Route::post('/inscripciones/agregar/{catedra}/{cursante}','InscripcionesController@add')->name('inscripciones.add')->middleware('auth');
Route::delete('/inscripciones/{inscripcion}','InscripcionesController@delete')->name('inscripciones.delete')->middleware('auth');

Route::get('/conocimientos','ConocimientosController@index')->name('conocimientos.index')->middleware('auth');
Route::get('/conocimientos/agregar','ConocimientosController@new')->name('conocimientos.new')->middleware('auth');
Route::post('/conocimientos/agregar','ConocimientosController@add')->name('conocimientos.add')->middleware('auth');
Route::delete('/conocimientos/{conocimiento}','ConocimientosController@delete')->name('conocimientos.delete')->middleware('auth');

Route::get('/calendario','CalendariosController')->name('calendarios.index')->middleware('auth');

Route::get('/presentismo/search/{fecha?}','PresentesController@index')->name('presentes.index')->middleware('auth');
Route::get('/presentismo/{fecha}','PresentesController@edit')->name('presentes.edit')->middleware('auth');
Route::post('/presentismo/{fecha}','PresentesController@add')->name('presentes.add')->middleware('auth');

Route::get('/ejes','EjesController@index')->name('ejes.index')->middleware('auth');
Route::get('/ejes/agregar','EjesController@new')->name('ejes.new')->middleware('auth');
Route::post('/ejes/agregar','EjesController@add')->name('ejes.add')->middleware('auth');
Route::get('/ejes/{eje}','EjesController@edit')->name('ejes.edit')->middleware('auth');
Route::put('/ejes/{eje}','EjesController@update')->name('ejes.update')->middleware('auth');
Route::delete('/panel/ejes/{eje}','EjesController@delete')->name('ejes.delete')->middleware('auth');

Route::get('/contenidos/{catedra}/fechas','ContenidosController@fechas')->name('contenidos.fechas')->middleware('auth');
Route::get('/contenidos/{fecha}','ContenidosController@edit')->name('contenidos.edit')->middleware('auth');
Route::post('/contenidos/{fecha}/titulo/','ContenidosController@add_title')->name('contenidos.add_titulo')->middleware('auth');
Route::post('/contenidos/{fecha}/texto/','ContenidosController@add_text')->name('contenidos.add_texto')->middleware('auth');
Route::post('/contenidos/{fecha}/imagen/','ContenidosController@add_image')->name('contenidos.add_imagen')->middleware('auth');
Route::post('/contenidos/{fecha}/archivo/','ContenidosController@add_file')->name('contenidos.add_archivo')->middleware('auth');
Route::post('/contenidos/{fecha}/video/','ContenidosController@add_video')->name('contenidos.add_video')->middleware('auth');
Route::post('/contenidos/{fecha}','ContenidosController@order')->name('contenidos.order')->middleware('auth');
Route::delete('/contenidos/{contenido}','ContenidosController@delete')->name('contenidos.delete')->middleware('auth');

Route::get('/contenidos/file/{contenido}','ContenidosController@get_file')->name('contenidos.getfile');
