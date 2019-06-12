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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('sensor')->group(function (){

    //Route::get('getItemValidate', 'ItemController@getItem');
    //Route::get('info/{valor}', 'ReportController@getInfo');
    Route::get('validar', 'SensorController@validar');
    Route::get('listSensor', 'SensorController@getList');
    Route::get('mostrar/{codigo}/{limit?}', 'SensorController@mostrar');
});
Route::prefix('param')->group(function (){
    Route::resource('sensor', 'SensorController');
    Route::resource('central', 'CentralController');
});

Route::prefix('control')->group(function (){
    Route::resource('asignacion', 'AsignacionController');
    Route::resource('vehiculo', 'VehiculoController');
    Route::get('getPdf/{id}', 'VehiculoController@getPdf');
});

Route::prefix('admin')->group(function (){
    Route::get('updateRol', 'UserController@updateRol');
    Route::resource('user', 'UserController');
    Route::resource('rol', 'RolController');
    Route::resource('person', 'PersonController');
});

Route::prefix('report')->group(function (){
    Route::resource('reporte', 'ReporteController');
    Route::get('list', 'ReporteController@getList');
});

Route::get('user/{name?}', function ($name = null) {
    return $name;
});