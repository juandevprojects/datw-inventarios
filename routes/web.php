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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'WelcomeController');

Auth::routes();

// Ruta para mostrar la vista de home. home es la vista que te dá luego que te logeas, y el middleware de autorización está en el contralador
Route::get('/home', 'HomeController@index')->name('home');

// Ruta de ejemplo para mostrar el usuario, en este caso el requerimiento de estar loggeado se realiza aquí utilizando el middleware aquí mismo
Route::get('user/{id}', 'UserController@show')->middleware('auth');

// Rutas para poder acceder a los recursos. Un recurso son las tablas de las bases de datos
Route::group(['middleware' => 'auth'], function () {
    Route::resources([
        'marcas' => 'MarcaController',
        'ubicacions' => 'UbicacionController',
        'teclados' => 'TecladoController', // Se agrega abajo una ruta de borrado porque tiene el botón de ver y ejecuta el método show
        // *******Sin embargo modifica el archivo show.blade de teclado para que no necesites hacer una ruta para borrar sino todo lo haces desde el controlador de show. // Para hacer todo esto necesitamos poner los botones de borrar y modificar como un formulario con el metodo "delete" para que se vaya directamente al método destroy del controlador
        'ordenadors' => 'OrdenadorController',
        'monitors' => 'MonitorController',
        'ratons' => 'RatonController',
        'softwares' => 'SoftwareController',
        'components' => 'ComponentController',
        'impresoras' => 'ImpresoraController',
        'dispreds' => 'DispredController',
        'soft_pcs' => 'Soft_pcController',
    ]);

    Route::get('teclados/showdelete/{id}', 'TecladoController@showdelete')->name('muestraBorradoTeclado');
    Route::get('ordenadors/showdelete/{id}', 'OrdenadorController@showdelete')->name('muestraBorradoOrd');
    Route::get('monitors/showdelete/{id}', 'MonitorController@showdelete')->name('muestraBorradoMonitor');
    Route::get('ratons/showdelete/{id}', 'RatonController@showdelete')->name('muestraBorradoRaton');
    Route::get('softwares/showdelete/{id}', 'SoftwareController@showdelete')->name('muestraBorradoSoftware');
    Route::get('components/showdelete/{id}', 'ComponentController@showdelete')->name('muestraBorradoComponent');
    Route::get('impresoras/showdelete/{id}', 'ImpresoraController@showdelete')->name('muestraBorradoImpresora');
    Route::get('dispreds/showdelete/{id}', 'DispredController@showdelete')->name('muestraBorradoDispred');
    Route::get('soft_pcs/showdelete/{id}', 'Soft_pcController@showdelete')->name('muestraBorradoSoft_pc');



});


