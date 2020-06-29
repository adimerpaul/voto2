<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/candidato', 'HomeController@index');
Route::post('/import-excel-personas','ElectoresController@ImportPersonas');
Route::apiResource('/elector','ElectoresController');
Route::post('/wordElector','ElectoresController@wordElector')->middleware('auth')->name('wordElector');
Route::delete('/eliminar/{elector}','ElectoresController@eliminar')->middleware('auth');
