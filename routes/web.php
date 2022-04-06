<?php



Route::get('/clear-cache', function() {
Artisan::call('cache:clear');
Artisan::call('view:clear');
Artisan::call('config:cache');
Artisan::call('config:clear');
return "Cache is cleared"; // you can replce your redirect
});


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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();




Route::get('/', 'HomeController@index')->name('home');

Route::get('politico-institucional/{tipo}','PoliticoController@index')->name('politico.index')->middleware('auth');

Route::get('municipios/{tipo}','MunicipioController@index')->name('municipios.index')->middleware('auth');

Route::get('vivienda/{tipo}','ViviendaController@index')->name('vivienda.index')->middleware('auth');

Route::get('electoral/{tipo}','ElectoralController@index')->name('electoral.index')->middleware('auth');

Route::get('electoral17/{tipo}','Electoral17Controller@index')->name('electoral17.index')->middleware('auth');

Route::get('productivo/{tipo}','ProductivoController@index')->name('productivo.index')->middleware('auth');

Route::get('sanitario/{tipo}','SanitarioController@index')->name('sanitario.index')->middleware('auth');

Route::get('especial/{tipo}', 'EspecialController@index')->name('especial.index')->middleware('auth');

Route::get('educacion/{tipo}','EducacionController@index')->name('educacion.index')->middleware('auth');

Route::get('discapacitado/{tipo}', 'DiscapacitadoController@index')->name('discapacitado.index')->middleware('auth');

Route::get('cultura/{tipo}','CulturaController@index')->name('cultura.index')->middleware('auth');

Route::get('medioambiente/{tipo}','MedioambienteController@index')->name('medioambiente.index')->middleware('auth');

Route::get('genero/{tipo}','GeneroController@index')->name('genero.index')->middleware('auth');

Route::get('geografia/{tipo}','GeografiaController@index')->name('geografia.index')->middleware('auth');

Route::get('fuentes-informacion','FuentesInformacionController@index')->name('fuentes.index')->middleware('auth');

Route::get('users','UserController@index')->name('user.index')->middleware('auth');


/********************** Rutas Eje ECONOMICO **********************/
Route::get('economico','EconomicoController@index')->name('economico.index')->middleware('auth');
Route::get('economico-gastos','EconomicoController@composicionGastos')->name('economico.comp_gastos')->middleware('auth');
Route::get('transferencias/{param?}','EconomicoController@transferencias')->name('transferencias')->middleware('auth');
Route::get('gastos','EconomicoController@gastos')->name('gastos')->middleware('auth');
/**************************************************************** */

Route::get('construccion', function () {
    return view('layouts.construccion');
})->name('construccion');
